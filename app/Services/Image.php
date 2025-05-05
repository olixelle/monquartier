<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\URL;

class Image
{
    public function getPublicUrl($filename) {

        if (empty($filename)) {
            return "";
        }

        $path = '/images/' . $filename;

        return URL::to($path);
    }

    /**
     * Traite une image Base64, la stocke et retourne le nom du fichier
     *
     * @param string $base64Image Image au format base64
     * @return string Nom du fichier généré
     * @throws Exception
     */
    public function saveImage(string $base64Image): string
    {
        // Vérifier si l'image est valide
        if (!$this->isValidBase64Image($base64Image)) {
            throw new Exception('Format d\'image Base64 invalide');
        }

        // Extraire le type MIME et le contenu
        list($mimeType, $imageData) = $this->extractImageData($base64Image);

        // Déterminer l'extension en fonction du type MIME
        $extension = $this->getExtensionFromMimeType($mimeType);

        // Générer un UUID de 10 caractères
        $filename = Str::uuid()->toString();
        $filename = substr($filename, 0, 10);

        // Créer le chemin de dossier basé sur les caractères du nom de fichier
        $folderPath = $this->createNestedFolderPath($filename);

        // Nom complet du fichier avec extension
        $fullFilename = $filename . '.' . $extension;

        // Stocker l'image
        Storage::put($folderPath . '/' . $fullFilename, base64_decode($imageData));

        return $fullFilename;
    }

    /**
     * Vérifie si la chaîne est une image base64 valide
     *
     * @param string $base64Image
     * @return bool
     */
    private function isValidBase64Image(string $base64Image): bool
    {
        // Vérifier le format de base64 avec en-tête
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image)) {
            return false;
        }

        // Extraire les données encodées
        $encodedImg = substr($base64Image, strpos($base64Image, ',') + 1);

        // Vérifier si c'est un base64 valide
        $decodedImg = base64_decode($encodedImg, true);

        return $decodedImg !== false;
    }

    /**
     * Extrait le type MIME et les données de l'image
     *
     * @param string $base64Image
     * @return array [mimeType, imageData]
     */
    private function extractImageData(string $base64Image): array
    {
        // Format attendu: data:image/jpeg;base64,ABC123...
        preg_match('/^data:image\/(\w+);base64,(.+)$/', $base64Image, $matches);

        $mimeType = 'image/' . $matches[1]; // image/jpeg, image/png, etc.
        $imageData = $matches[2];

        return [$mimeType, $imageData];
    }

    /**
     * Retourne l'extension de fichier correspondant au type MIME
     *
     * @param string $mimeType
     * @return string
     */
    private function getExtensionFromMimeType(string $mimeType): string
    {
        $mimeToExt = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/bmp' => 'bmp',
            'image/svg+xml' => 'svg'
        ];

        return $mimeToExt[$mimeType] ?? 'jpg';
    }

    /**
     * Crée un chemin de dossier imbriqué basé sur chaque caractère du nom de fichier
     *
     * @param string $filename
     * @return string
     */
    private function createNestedFolderPath(string $filename): string
    {
        $folderPath = '';

        // Créer un dossier pour chaque caractère du nom de fichier
        for ($i = 0; $i < strlen($filename); $i++) {
            $folderPath .= $filename[$i] . '/';

            // Créer le dossier s'il n'existe pas
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }
        }

        return rtrim($folderPath, '/');
    }
}
