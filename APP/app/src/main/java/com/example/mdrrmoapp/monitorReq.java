package com.example.mdrrmoapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;

public class monitorReq extends AppCompatActivity {
    TextView v1,v2,v3,v4,v5,v6,v7;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_monitor_req);
        v1 = findViewById(R.id.textView2);
        v2 = findViewById(R.id.textView4);
        v3 = findViewById(R.id.textView6);
        v4 = findViewById(R.id.textView8);
        v5 = findViewById(R.id.textView154);
        SharedPreferences sp = getSharedPreferences("credentials", MODE_PRIVATE);
        if (sp.contains("uname"))
        {
            v1.setText(sp.getString("uname", ""));
        }

        getData();
    }
    private void getData() {
        String names = v1.getText().toString().trim();


        if (names.equals("")) {

            Toast.makeText(this, "Check Detail!", Toast.LENGTH_LONG).show();
            return;
        }

        String url = config1.DATA_URL + v1.getText().toString().trim();

        StringRequest stringRequest = new StringRequest(url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                showJSONS(response);
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(monitorReq.this, error.getMessage().toString(), Toast.LENGTH_LONG).show();
                    }
                });
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
    private void showJSONS(String response) {

        String name = "";
        String name1="";
        String name2="";
        String name3="";
        String name4="";
        ArrayList<HashMap<String, String>> list = new ArrayList<HashMap<String, String>>();
        try {
            JSONObject jsonObject = new JSONObject(response);
            JSONArray result = jsonObject.getJSONArray(config1.JSON_ARRAY);

            for (int i = 0; i < result.length(); i++) {
                JSONObject jo = result.getJSONObject(i);
                name = jo.getString(config1.NAME);
                name1 = jo.getString(config1.NAME1);
                name2 = jo.getString(config1.LONG);
                name3 = jo.getString(config1.LAT);
                name4 = jo.getString(config1.STAT);
                final HashMap<String, String> user = new HashMap<>();
                user.put(config1.NAME,name);
                user.put(config1.NAME1, name1);
                user.put(config1.LONG,name2);
                user.put(config1.LAT,name3);
                user.put(config1.STAT, name4);


                list.add(user);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        v5.setText(name.toUpperCase() + " " + name1.toUpperCase());
        v1.setText(name.toUpperCase() + " " + name1.toUpperCase());
        v2.setText(name2);
        v3.setText(name3);
        v4.setText(name4.toUpperCase());
    }

}