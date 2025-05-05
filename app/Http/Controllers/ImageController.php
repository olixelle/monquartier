<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageController extends Controller
{
    /**
     * Récupère et affiche une image générée à partir de son nom
     *
     * @param string $filename Le nom du fichier de l'image (avec extension)
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function show(string $filename)
    {
        // Extrait l'extension pour déterminer le type MIME
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // Détermine le type MIME basé sur l'extension
        $mimeType = $this->getMimeTypeFromExtension($extension);

        // Construit le chemin du fichier basé sur les caractères du nom de fichier
        $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
        $folderPath = $this->buildFolderPath($filenameWithoutExt);
        $fullPath = $folderPath . '/' . $filename;

        // Vérifie si le fichier existe
        if (!Storage::exists($fullPath)) {
            throw new NotFoundHttpException('Image non trouvée');
        }

        // Retourne le fichier avec le bon type MIME
        return Storage::response($fullPath, $filename, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    /**
     * Construit le chemin du dossier imbriqué basé sur chaque caractère du nom de fichier
     *
     * @param string $filename Nom du fichier sans extension
     * @return string
     */
    private function buildFolderPath(string $filename): string
    {
        $folderPath = '';

        // Crée un segment de chemin pour chaque caractère du nom de fichier
        for ($i = 0; $i < strlen($filename); $i++) {
            $folderPath .= $filename[$i] . '/';
        }

        return rtrim($folderPath, '/');
    }

    /**
     * Détermine le type MIME à partir de l'extension du fichier
     *
     * @param string $extension
     * @return string
     */
    private function getMimeTypeFromExtension(string $extension): string
    {
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'bmp' => 'image/bmp',
            'svg' => 'image/svg+xml',
        ];

        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }
}
