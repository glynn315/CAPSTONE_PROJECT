package com.example.mdrrmoapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

public class MainActivity4 extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main4);
    }

    public void firecall(View view) {
        Uri u = Uri.parse("tel:" + "09638281253");

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

    public void policecall(View view) {
        Uri u = Uri.parse("tel:" + "0938234568");

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

    public void hospcall(View view) {
        Uri u = Uri.parse("tel:" + "09994995878");

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