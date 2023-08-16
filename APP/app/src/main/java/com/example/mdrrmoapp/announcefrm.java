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

public class announcefrm extends AppCompatActivity {
    TextView v1,v2,v3,v4,v5;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_announcefrm);
        v2 = findViewById(R.id.textView2);
        v3 = findViewById(R.id.textView4);
        v4 = findViewById(R.id.textView6);
        v5 = findViewById(R.id.textView8);


        getData();
    }
    private void getData() {
        String url = config2.DATA_URL;

        StringRequest stringRequest = new StringRequest(url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                showJSONS(response);
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(announcefrm.this, error.getMessage().toString(), Toast.LENGTH_LONG).show();
                    }
                });
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
    private void showJSONS(String response) {

        String name2 = "";
        String name3 ="";
        String name4 = "";
        String name5 ="";
        ArrayList<HashMap<String, String>> list = new ArrayList<HashMap<String, String>>();
        try {
            JSONObject jsonObject = new JSONObject(response);
            JSONArray result = jsonObject.getJSONArray(config2.JSON_ARRAY);
            for (int i = 0; i < result.length(); i++) {
                JSONObject jo = result.getJSONObject(i);
                name2 = jo.getString(config2.ANNOUNCE);
                name3 = jo.getString(config2.START);
                name4 = jo.getString(config2.END);
                name5 = jo.getString(config2.STAT);


                final HashMap<String, String> employees = new HashMap<>();
                employees.put(config2.ANNOUNCE,name2);
                employees.put(config2.START,name3);
                employees.put(config2.END, name4);
                employees.put(config2.STAT, name5);
                list.add(employees);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        v2.setText(name2.toUpperCase());
        v3.setText(name3);
        v4.setText(name4);
        v5.setText(name5.toUpperCase());
    }
}