package com.example.mdrrmoapp;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.Manifest;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationManager;
import android.os.Bundle;
import android.provider.Settings;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.skyfishjy.library.RippleBackground;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class dashreq extends AppCompatActivity {
    private static  final int REQUEST_LOCATION=1;
    TextView tv,longs,lats,samp;
    LocationManager locationManager;
    String latitude,longitude;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashreq);
        final RippleBackground rippleBackground=(RippleBackground)findViewById(R.id.rp1);
        TextView textView=findViewById(R.id.help);
        rippleBackground.startRippleAnimation();
        tv=(TextView)findViewById(R.id.textView8);
        samp = findViewById(R.id.textView10);



        SharedPreferences sp=getSharedPreferences("credentials",MODE_PRIVATE);
        if(sp.contains("uname"))
            tv.setText(sp.getString("uname",""));

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
                        Toast.makeText(dashreq.this, error.getMessage().toString(), Toast.LENGTH_LONG).show();
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
        samp.setText(id);
    }
    public void dashboard(View view) {
        startActivity(new Intent(this,dashmain.class));
    }
    public void request(View view) {
        startActivity(new Intent(this,helpOption.class));
    }
}