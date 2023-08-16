package com.example.mdrrmoapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
    private static final String apiurl="https://nmdrrmo.com/admin/DASHBOARD/Connection/login_maker.php";
    public static String PREFS = "myprefs";
    EditText t1,t2;
    TextView tv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    public void reg(View view)
    {
        startActivity(new Intent(this,regFrm.class));
    }


    public void login(View view) {
        t1=(EditText)findViewById(R.id.editTextTextPersonName);
        t2=(EditText)findViewById(R.id.editTextNumberPassword);
        tv=(TextView)findViewById(R.id.textView4);

        String qry="?t1="+t1.getText().toString().trim()+"&t2="+t2.getText().toString().trim();

        class dbprocess extends AsyncTask<String,Void,String>
        {
            @Override
            protected  void onPostExecute(String data)
            {
                if(data.equals("FOUND"))
                {
                    SharedPreferences sp=getSharedPreferences("credentials",MODE_PRIVATE);
                    SharedPreferences.Editor editor=sp.edit();
                    editor.putString("uname",t1.getText().toString());
                    editor.commit();
//                    SharedPreferences shared = getSharedPreferences(MainActivity.PREFS,0);
//                    SharedPreferences.Editor edit = shared.edit();
//
//                    edit.putBoolean("hasLoggedin" ,true);
//                    edit.commit();
                    startActivity(new Intent(getApplicationContext(),dashreq.class));
                    finish();
                }
                else
                {
                    t1.setText("");
                    t2.setText("");
                    tv.setTextColor(Color.parseColor("#8B0000"));
                    tv.setText(data);
                }
            }
            @Override
            protected String doInBackground(String... params)
            {
                String furl=params[0];

                try
                {
                    URL url=new URL(furl);
                    HttpURLConnection conn=(HttpURLConnection)url.openConnection();
                    BufferedReader br=new BufferedReader(new InputStreamReader(conn.getInputStream()));

                    return br.readLine();

                }catch (Exception ex)
                {
                    return ex.getMessage();
                }
            }
        }

        dbprocess obj=new dbprocess();
        obj.execute(apiurl+qry);
    }
}