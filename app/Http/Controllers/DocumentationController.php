<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 * title="API Dokumentasi BKPSDM Katingan",
 * version="1.0.0",
 * description="Ini adalah dokumentasi API yang digunakan untuk website BKPSDM Katingan.",
 * @OA\Contact(
 * name="Developer",
 * email="deprowinoto3690@gmail.com"
 * )
 * )
 * 
 * @OA\Server(
 * url="http://127.0.0.1:8000",
 * description="Local Development Server"
 * )
 * 
 * @OA\Components(
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="http",
 * scheme="bearer",
 * bearerFormat="JWT",
 * description="Masukkan token yang didapat dari endpoint /api/login. Contoh: 1|aBcDeFgHiJkLmNoPqRsTuVwXyZ"
 * )
 * )
 * 
 * @OA\Tag(
 * name="Autentikasi",
 * description="Endpoint untuk login, logout, dan manajemen profil pengguna"
 * )
 * 
 * @OA\Tag(
 * name="Berita",
 * description="Endpoint untuk mengelola berita dan artikel"
 * )
 * 
 * @OA\Tag(
 * name="Galeri",
 * description="Endpoint untuk mengelola galeri foto"
 * )
 * 
 * @OA\Tag(
 * name="Unduhan",
 * description="Endpoint untuk mengelola file unduhan"
 * )
 * 
 * @OA\Tag(
 * name="Pejabat",
 * description="Endpoint untuk mengelola struktur organisasi/pejabat"
 * )
 * 
 * @OA\Tag(
 * name="Hero",
 * description="Endpoint untuk mengelola slide hero/banner halaman utama"
 * )
 * 
 * @OA\Tag(
 * name="Kontak",
 * description="Endpoint untuk mengelola pesan kontak dari pengguna"
 * )
 */
class DocumentationController extends Controller
{
    // This controller is only for OpenAPI documentation annotations
}
