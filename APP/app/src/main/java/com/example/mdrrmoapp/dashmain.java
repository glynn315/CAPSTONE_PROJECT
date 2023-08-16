package com.example.mdrrmoapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;

public class dashmain extends AppCompatActivity {
    TextView tv,wt,area;
    ImageView im;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashmain);
        SharedPreferences sp = getSharedPreferences("credentials", MODE_PRIVATE);
        wt = findViewById(R.id.textView11);
        tv=(TextView)findViewById(R.id.textView20);
        area=(TextView)findViewById(R.id.textView148);
        im  = findViewById(R.id.imageView11);


        String apikey = "API Key";
        String url = "https://api.openweathermap.org/data/2.5/weather?zip=9508,PH&appid=f094323029b99e01350d96c4c4f01cce";
        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    JSONObject object =  response.getJSONObject("main");
                    String temperature = object.getString("temp");
                    Double temp = Double.parseDouble(temperature)-273.15;
                    wt.setText(temp.toString().substring(0,5));

                    Integer weather = wt.getText().length();

                    if(weather <= 26)
                    {
                        area.setText("No Sign of RAINING");
                    }
                    else if(weather >= 27)
                    {
                        area.setText("Too Hot");
                    }
                    else if(weather <= 19)
                    {
                        area.setText("Almost Raining");
                    }

                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(),e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener()
        {
            public void onErrorResponse(VolleyError error)
            {
                Toast.makeText(dashmain.this,error.toString(), Toast.LENGTH_SHORT).show();
            }
        });

        queue.add(request);

        if (sp.contains("uname"))
        {
            tv.setText(sp.getString("uname", ""));
        }

        getData();
    }

    private void getData() {
        String names = tv.getText().toString().trim();


        if (names.equals("")) {

            Toast.makeText(this, "Check Detail!", Toast.LENGTH_LONG).show();
            return;
        }

        String url = config.DATA_URL + tv.getText().toString().trim();

        StringRequest stringRequest = new StringRequest(url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                showJSONS(response);
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(dashmain.this, error.getMessage().toString(), Toast.LENGTH_LONG).show();
                    }
                });
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
    private void showJSONS(String response) {

        String id ="";
        String name = "";
        String name1="";
        ArrayList<HashMap<String, String>> list = new ArrayList<HashMap<String, String>>();
        try {
            JSONObject jsonObject = new JSONObject(response);
            JSONArray result = jsonObject.getJSONArray(config.JSON_ARRAY);

            for (int i = 0; i < result.length(); i++) {
                JSONObject jo = result.getJSONObject(i);
                name = jo.getString(config.KEY_NAME);
                name1 = jo.getString(config.KEY_NAME1);
                id = jo.getString(config.KEY_ID);



                final HashMap<String, String> employees = new HashMap<>();
                employees.put(config.KEY_ID,id);
                employees.put(config.KEY_NAME,name);
                employees.put(config.KEY_NAME1, name1);

                list.add(employees);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        tv.setText(name.toUpperCase() + " " + name1.toUpperCase());
    }

    public void person(View view) {
        startActivity(new Intent(this,personfrm.class));
    }

    public void Flood(View view) {
        startActivity(new Intent(getApplicationContext(),floodfrm.class));
        finish();
    }

    public void Quake(View view) {
        startActivity(new Intent(getApplicationContext(),earthfrm.class));
        finish();
    }

    public void vehic(View view) {
        startActivity(new Intent(getApplicationContext(),carfrm.class));
        finish();
    }

    public void Fire(View view) {
        startActivity(new Intent(getApplicationContext(),firefrm.class));
        finish();
    }

    public void Health(View view) {
        startActivity(new Intent(getApplicationContext(),healthfrm.class));
        finish();
    }


    public void logout(View view) {
        SharedPreferences sp=getSharedPreferences("credentials",MODE_PRIVATE);
        if(sp.contains("uname"))
        {
            SharedPreferences.Editor editor=sp.edit();
            editor.remove("uname");
            SharedPreferences shared = getSharedPreferences(MainActivity.PREFS,0);
            SharedPreferences.Editor edit = shared.edit();

            editor.putString("msg","Logged out Successfully");
            editor.commit();
            startActivity(new Intent(getApplicationContext(),MainActivity.class));
        }
    }

    public void evac(View view) {
        startActivity(new Intent(getApplicationContext(),MainActivity5.class));
        finish();
    }

    public void monreq(View view) {
        startActivity(new Intent(getApplicationContext(),monitorReq.class));
        finish();
    }

    public void announce(View view) {
        startActivity(new Intent(getApplicationContext(),announcefrm.class));
        finish();
    }

    public void directory(View view) {
        startActivity(new Intent(getApplicationContext(),MainActivity4.class));
        finish();
    }
}
