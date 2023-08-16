package com.example.mdrrmoapp;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.location.Location;
import android.location.LocationManager;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.provider.Settings;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionDeniedResponse;
import com.karumi.dexter.listener.PermissionGrantedResponse;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.single.PermissionListener;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class helpOption extends AppCompatActivity {

    Button OpCam,Uplaod;
    ImageView display;
    private static final int REQUEST_LOCATION = 1;
    TextView tv, longs, lats, samp ,contact;
    LocationManager locationManager;
    String latitude, longitude;
    Bitmap bitmap;
    String encodedimage;
    private static final String apiurl="https://nmdrrmo.com/admin/DASHBOARD/Connection/sendRequest.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_help_option);
        OpCam = findViewById(R.id.button6);
        display = findViewById(R.id.imageView7);
        tv = (TextView) findViewById(R.id.txtname);
        samp = findViewById(R.id.txtid);
        contact = findViewById(R.id.txtcontact);
        Uplaod = findViewById(R.id.button7);



        SharedPreferences sp = getSharedPreferences("credentials", MODE_PRIVATE);
        if (sp.contains("uname"))
            tv.setText(sp.getString("uname", ""));

        getData();

        ActivityCompat.requestPermissions(this, new String[]
                {Manifest.permission.ACCESS_FINE_LOCATION}, REQUEST_LOCATION);

        longs = findViewById(R.id.txtlongitude);
        lats = findViewById(R.id.txtlatitude);

        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);

        //Check gps is enable or not
        if (ContextCompat.checkSelfPermission(helpOption.this, Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(helpOption.this, new String[]
                            {
                                    Manifest.permission.CAMERA
                            },
                    100);
        }
        Uplaod.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                uploadtoserver();
            }
        });
        if (!locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
            OnGPS();
        } else {
            getLocation();
        }
        OpCam.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Dexter.withContext(getApplicationContext())
                        .withPermission(Manifest.permission.CAMERA)
                        .withListener(new PermissionListener() {
                            @Override
                            public void onPermissionGranted(PermissionGrantedResponse permissionGrantedResponse) {
                                Intent intent=new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                                startActivityForResult( intent,111);
                            }
                            @Override
                            public void onPermissionDenied(PermissionDeniedResponse permissionDeniedResponse) {
                            }
                            @Override
                            public void onPermissionRationaleShouldBeShown(PermissionRequest permissionRequest, PermissionToken permissionToken) {
                                permissionToken.continuePermissionRequest();
                            }
                        }).check();
            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if(requestCode==111 && resultCode==RESULT_OK)
        {
            bitmap=(Bitmap)data.getExtras().get("data");
            display.setImageBitmap(bitmap);
            encodebitmap(bitmap);
        }
        super.onActivityResult(requestCode, resultCode, data);
    }
    private void encodebitmap(Bitmap bitmap)
    {
        ByteArrayOutputStream byteArrayOutputStream=new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG,100,byteArrayOutputStream);

        byte[] byteofimages=byteArrayOutputStream.toByteArray();
        encodedimage=android.util.Base64.encodeToString(byteofimages, Base64.DEFAULT);
    }
    private void getLocation() {
        if (ActivityCompat.checkSelfPermission(helpOption.this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(helpOption.this,

                Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]
                    {Manifest.permission.ACCESS_FINE_LOCATION}, REQUEST_LOCATION);
        } else {
            Location LocationGps = locationManager.getLastKnownLocation(LocationManager.GPS_PROVIDER);
            Location LocationNetwork = locationManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
            Location LocationPassive = locationManager.getLastKnownLocation(LocationManager.PASSIVE_PROVIDER);

            if (LocationGps != null) {
                double lat = LocationGps.getLatitude();
                double longi = LocationGps.getLongitude();

                latitude = String.valueOf(lat);
                longitude = String.valueOf(longi);

                lats.setText(latitude);
                longs.setText(longitude);
            } else if (LocationNetwork != null) {
                double lat = LocationNetwork.getLatitude();
                double longi = LocationNetwork.getLongitude();

                latitude = String.valueOf(lat);
                longitude = String.valueOf(longi);

                lats.setText(latitude);
                longs.setText(longitude);
            } else if (LocationPassive != null) {
                double lat = LocationPassive.getLatitude();
                double longi = LocationPassive.getLongitude();

                latitude = String.valueOf(lat);
                longitude = String.valueOf(longi);

                lats.setText(latitude);
                longs.setText(longitude);
            } else {
                Toast.makeText(this, "Can't Get Your Location", Toast.LENGTH_SHORT).show();
            }
        }

    }

    private void OnGPS() {
        final AlertDialog.Builder builder = new AlertDialog.Builder(this);

        builder.setMessage("Enable GPS").setCancelable(false).setPositiveButton("YES", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                startActivity(new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS));
            }
        }).setNegativeButton("NO", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {

                dialog.cancel();
            }
        });
        final AlertDialog alertDialog = builder.create();
        alertDialog.show();
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
                        Toast.makeText(helpOption.this, error.getMessage().toString(), Toast.LENGTH_LONG).show();
                    }
                });
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void showJSONS(String response) {

        String id = "";
        String name = "";
        String name1 = "";
        String cons = "";
        ArrayList<HashMap<String, String>> list = new ArrayList<HashMap<String, String>>();
        try {
            JSONObject jsonObject = new JSONObject(response);
            JSONArray result = jsonObject.getJSONArray(config.JSON_ARRAY);

            for (int i = 0; i < result.length(); i++) {
                JSONObject jo = result.getJSONObject(i);
                name = jo.getString(config.KEY_NAME);
                name1 = jo.getString(config.KEY_NAME1);
                id = jo.getString(config.KEY_ID);
                cons = jo.getString(config.CONTACT);


                final HashMap<String, String> employees = new HashMap<>();
                employees.put(config.KEY_ID, id);
                employees.put(config.KEY_NAME, name);
                employees.put(config.KEY_NAME1, name1);
                employees.put(config.CONTACT,cons);

                list.add(employees);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        tv.setText(name.toUpperCase() + " " + name1.toUpperCase());
        samp.setText(id);
        contact.setText(cons);
    }
    private void uploadtoserver()
    {
        final String ID = samp.getText().toString().trim();
        final String LONG=longs.getText().toString().trim();
        final String LATS=lats.getText().toString().trim();

        StringRequest request=new StringRequest(Request.Method.POST, apiurl, new Response.Listener<String>() {
            @Override
            public void onResponse(String response)
            {
                Toast.makeText(getApplicationContext(),"WAITING for the RESPONDENTS",Toast.LENGTH_SHORT).show();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(),error.toString(),Toast.LENGTH_SHORT).show();
            }
        })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError
            {
                Map<String,String> map=new HashMap<String, String>();
                map.put("samp",ID);
                map.put("longs",LONG);
                map.put("lats",LATS);
                map.put("upload",encodedimage);
                return map;
            }
        };
        RequestQueue queue= Volley.newRequestQueue(getApplicationContext());
        queue.add(request);
    }

    public void call(View view) {
        Uri u = Uri.parse("tel:" + "09569435938");

        Intent i = new Intent(Intent.ACTION_DIAL, u);

        try
        {
            startActivity(i);
        }
        catch (SecurityException s)
        {

            Toast.makeText(this, "An error occurred", Toast.LENGTH_LONG)
                    .show();
        }
    }
}
//    @Override
//    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
//        if (requestCode == 100)
//        {
//            Bitmap captureImage = (Bitmap) data.getExtras().get("date");
//            display.setImageBitmap(captureImage);
//        }
//    }
