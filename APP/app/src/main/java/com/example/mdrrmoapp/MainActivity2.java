package com.example.mdrrmoapp;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.skyfishjy.library.RippleBackground;

public class MainActivity2 extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        final RippleBackground rippleBackground=(RippleBackground)findViewById(R.id.rp1);
        ImageView imageView=(ImageView)findViewById(R.id.txt);

        rippleBackground.startRippleAnimation();

    }
}