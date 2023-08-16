package com.example.mdrrmoapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
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

public class personfrm extends AppCompatActivity {
    TextView v1,v2,v3,v4,v5,v6,v7;
    Button edit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_personfrm);

        v1 = findViewById(R.id.textView18);
        v2 = findViewById(R.id.textView19);
        v3 = findViewById(R.id.textView22);
        v4 = findViewById(R.id.textView24);
        v5 = findViewById(R.id.textView27);
        v6 = findViewById(R.id.textView29);
        //v7 = findViewById(R.id.textView29);
        SharedPreferences sp = getSharedPreferences("credentials", MODE_PRIVATE);
        if (sp.contains("uname"))
        {
            v1.setText(sp.getString("uname", ""));
        }

        getData();

//        edit = findViewById(R.id.button3);
//        edit.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                startActivity(new Intent(getApplicationContext(),updateImage.class));
//                finish();
//            }
//        });
    }

    private void getData() {
        String names = v1.getText().toString().trim();


        if (names.equals("")) {

            Toast.makeText(this, "Check Detail!", Toast.LENGTH_LONG).show();
            return;
        }

        String url = config.DATA_URL + v1.getText().toString().trim();

        StringRequest stringRequest = new StringRequest(url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                showJSONS(response);
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(personfrm.this, error.getMessage().toString(), Toast.LENGTH_LONG).show();
                    }
                });
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
    private void showJSONS(String response) {

        String name = "";
        String name1="";
        String add1="";
        String add2="";
        String gen="";
        String con="";
        String birth="";
        String stat1="";
        ArrayList<HashMap<String, String>> list = new ArrayList<HashMap<String, String>>();
        try {
            JSONObject jsonObject = new JSONObject(response);
            JSONArray result = jsonObject.getJSONArray(config.JSON_ARRAY);

            for (int i = 0; i < result.length(); i++) {
                JSONObject jo = result.getJSONObject(i);
                name = jo.getString(config.KEY_NAME);
                name1 = jo.getString(config.KEY_NAME1);
                add1 = jo.getString(config.ADD1);
                add2 = jo.getString(config.ADD2);
                gen = jo.getString(config.GENDER);
                con = jo.getString(config.CONTACT);
                birth = jo.getString(config.BDAY);
                stat1 = jo.getString(config.STATUS);



                final HashMap<String, String> user = new HashMap<>();
                user.put(config.KEY_NAME,name);
                user.put(config.KEY_NAME1, name1);
                user.put(config.ADD1,add1);
                user.put(config.ADD2,add2);
                user.put(config.GENDER,gen);
                user.put(config.CONTACT,con);
                user.put(config.BDAY,birth);
                user.put(config.STATUS, stat1);

                list.add(user);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        v1.setText(name.toUpperCase() + " " + name1.toUpperCase());
        v2.setText(add1.toUpperCase() + " " + add2.toUpperCase());
        v3.setText(gen.toUpperCase());
        v4.setText(con.toUpperCase());
        v5.setText(birth.toUpperCase());
        v6.setText(stat1.toUpperCase());
        //v7.setText(stat1.toUpperCase());
    }
}