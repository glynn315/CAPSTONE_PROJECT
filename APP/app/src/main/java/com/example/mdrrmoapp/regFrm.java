package com.example.mdrrmoapp;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.MediaStore;
import android.util.Base64;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
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
import java.util.Locale;

public class regFrm extends AppCompatActivity implements AdapterView.OnItemSelectedListener {
    EditText fname,lname,contact,register,username,password;
    Button insert,openCam;
    private static final String REGISTER_URL = "https://nmdrrmo.com/admin/DASHBOARD/Connection/insert.php";
    Spinner spinner, addspin;
    Bitmap bitmap;
    ImageView display;
    String encodedimage;

    ArrayList<String> countryList = new ArrayList<>();
    ArrayAdapter<String> countryAdapter;
    RequestQueue requestQueue;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reg_frm);
        fname = (EditText)findViewById(R.id.editTextTextPersonName2);
        lname = (EditText)findViewById(R.id.editTextTextPersonName3);
        contact = (EditText)findViewById(R.id.editTextTextPersonName4);
        display = findViewById(R.id.imageView15);
        register = (EditText)findViewById(R.id.editTextTextPersonName5);
        username = (EditText)findViewById(R.id.editTextTextPersonName6);
        password = (EditText)findViewById(R.id.editTextNumberPassword2);
        openCam = findViewById(R.id.button3);

        spinner = findViewById(R.id.spinner);
        addspin = findViewById(R.id.spinner1);
        requestQueue = Volley.newRequestQueue(this);

        String url = "https://nmdrrmo.com/admin/DASHBOARD/Connection/populate.php";

        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(Request.Method.POST,
                url, null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    JSONArray jsonArray = response.getJSONArray("adresses");
                    for(int i=0; i<jsonArray.length();i++){
                        JSONObject jsonObject = jsonArray.getJSONObject(i);
                        String countryName = jsonObject.optString("address");
                        countryList.add(countryName);
                        countryAdapter = new ArrayAdapter<>(regFrm.this,
                                android.R.layout.simple_spinner_item, countryList);
                        countryAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
                        addspin.setAdapter(countryAdapter);

                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        });
        requestQueue.add(jsonObjectRequest);


        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,R.array.gender, android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        spinner.setAdapter(adapter);
        //spinner.setOnItemSelectedListener(this);
        insert = (Button)findViewById(R.id.button2);

        insert.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                registerUser();
            }
        });

        openCam.setOnClickListener(new View.OnClickListener() {
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
    private void registerUser() {
        String First = fname.getText().toString().trim().toLowerCase();
        String Last = lname.getText().toString().trim().toLowerCase();
        String Con = contact.getText().toString().trim().toLowerCase();
        String Reg = register.getText().toString().trim().toLowerCase();
        String Gen = spinner.getSelectedItem().toString().trim().toLowerCase();
        String User = username.getText().toString().trim().toLowerCase();
        String Pass = password.getText().toString().trim().toLowerCase();

        REGISTER(First,Last,Con,Reg,Gen,User,Pass);
    }

    private void REGISTER(String first, String last, String con, String reg,String gen, String user, String pass) {
        class RegisterUser extends AsyncTask<String, Void, String>
        {
            ProgressDialog loading;
            RegUserClass ruc = new RegUserClass();
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(regFrm.this, "Please Wait", null, true, true);
            }
            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
            }

            @Override
            protected String doInBackground(String... params) {
                HashMap<String, String> data = new HashMap<String, String>();

                data.put("fname", params[0]);
                data.put("lname", params[1]);
                data.put("contact", params[2]);
                data.put("reg", params[3]);
                data.put("gen", params[4]);
                data.put("username", params[5]);
                data.put("password", params[6]);
                data.put("upload",encodedimage);

                String result = ruc.sendPostRequest(REGISTER_URL, data);

                return result;
            }
        }
        RegisterUser ru = new RegisterUser();
        ru.execute(first,last,con,reg,gen,user,pass);

        fname.setText("");
        lname.setText("");
        contact.setText("");
        register.setText("");
        username.setText("");
        password.setText("");
    }


    public void exit(View view) {
        startActivity(new Intent(this,MainActivity.class));
    }

    @Override
    public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
        String choice = adapterView.getItemAtPosition(i).toString();
        Toast.makeText(getApplicationContext(),choice,Toast.LENGTH_LONG).show();
    }

    @Override
    public void onNothingSelected(AdapterView<?> adapterView) {

    }
}