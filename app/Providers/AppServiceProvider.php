<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('exists_in_siswa_or_guru', function ($attribute, $value, $parameters, $validator) {
            // Check if the value exists in the 'siswa' table for 'nisn'
            $existsInSiswa = \App\Models\Siswa::where('nisn', $value)->exists();

            // Check if the value exists in the 'guru' table for 'nip'
            $existsInGuru = \App\Models\Guru::where('nip', $value)->exists();

            // Return true if the value exists in either 'siswa' or 'guru'
            return $existsInSiswa || $existsInGuru;
        });
    }
}
