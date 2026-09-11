<?php

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function validasiNama(string $nama): string
{
    if ($nama === '') {
        return 'Nama wajib diisi.';
    }

    if (mb_strlen($nama) < 3) {
        return 'Nama minimal 3 karakter.';
    }

    return '';
}

function validasiNim(string $nim): string
{
    if ($nim === '') {
        return 'NIM wajib diisi.';
    }

    if (!preg_match('/^\d{8,15}$/', $nim)) {
        return 'NIM harus 8-15 digit.';
    }

    return '';
}

function validasiEmail(string $email): string
{
    if ($email === '') {
        return 'Email wajib diisi.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Format email tidak valid.';
    }

    return '';
}

function validasiPilihan(string $nilai, array $daftar, string $pesan): string
{
    if ($nilai === '') {
        return $pesan;
    }

    if (!in_array($nilai, $daftar, true)) {
        return 'Pilihan tidak valid.';
    }

    return '';
}

function validasiJumlah($jumlah): string
{
    if ($jumlah === null || $jumlah === '') {
        return 'Jumlah peserta wajib diisi.';
    }

    if (!filter_var($jumlah, FILTER_VALIDATE_INT)) {
        return 'Jumlah peserta harus berupa angka.';
    }

    if ($jumlah < 1 || $jumlah > 3) {
        return 'Jumlah peserta harus 1 sampai 3.';
    }

    return '';
}