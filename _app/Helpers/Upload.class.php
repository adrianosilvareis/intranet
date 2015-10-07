<?php

/**
 * Upload.class [HELPER]
 * Responsavel por executar upload de imagens, arquivos e midias no sistema;
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Upload {

    private $File;
    private $Name;
    private $Send;

    /** IMAGE UPLOAD */
    private $Width;
    private $Image;

    /** RESULTSET */
    private $Result;
    private $Error;

    /** DIRETORIO */
    private $Folder;
    private static $BaseDir;

    function __construct($BaseDir = null) {
        self::$BaseDir = ( (string) $BaseDir ? $BaseDir : '../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }
    
    /**
     * <b>Enviar Imagem:</b> Basta envelopar um $_FILES de uma imagem e caso queira um nome e uma largura personalizada.
     * Caso não informe a largura será¡ 1024!
     * @param FILES $Image = Enviar envelope de $_FILES (JPG ou PNG)
     * @param STRING $Name = Nome da imagems ( ou do artigo )
     * @param INT $Width = Largura da imagem ( 1024 padrÃ£o )
     * @param STRING $Folder = Pasta personalizada
     */
    public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
        $this->Width = ( (int) $Width ? $Width : 1024);
        $this->Folder = ( (string) $Folder ? $Folder : 'images');

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->UploadImage();
    }
    
     /**
     * <b>Enviar Arquivo:</b> Basta envelopar um $_FILES de um arquivo e caso queira um nome e um tamanho personalizado.
     * Caso não informe o tamanho será 2mb!
     * @param FILES $File = Enviar envelope de $_FILES (PDF ou DOCX)
     * @param STRING $Name = Nome do arquivo ( ou do artigo )
     * @param STRING $Folder = Pasta personalizada
     * @param STRING $MaxFileSize = Tamanho máximo do arquivo (2mb)
     */
    public function File(array $File, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $File;
        $this->Name = ((string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')));
        $this->Folder = ( (string) $Folder ? $Folder : 'files');
        $MaxFileSize = ( (int) $MaxFileSize ? $MaxFileSize : 2);

        $FileAccept = [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'application/pdf',
            'text/plain',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/x-zip-compressed'
        ];

        $this->saveFile($FileAccept, $MaxFileSize);
    }
    
    /**
     * <b>Enviar Média:</b> Basta envelopar um $_FILES de uma média e caso queira um nome e um tamanho personalizado.
     * Caso não informe o tamanho será¡ 40mb!
     * @param FILES $Media = Enviar envelope de $_FILES (MP3 ou MP4)
     * @param STRING $Name = Nome do arquivo ( ou do artigo )
     * @param STRING $Folder = Pasta personalizada
     * @param STRING $MaxFileSize = Tamanho máximo do arquivo (40mb)
     */
    public function Media(array $Media, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $Media;
        $this->Name = ((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ( (string) $Folder ? $Folder : 'medias');
        $MaxFileSize = ( (int) $MaxFileSize ? $MaxFileSize : 10);

        $FileAccept = [
            'audio/mp3',
            'video/mp4'
        ];

        $this->saveFile($FileAccept, $MaxFileSize);
    }

    /**
     * <b>Verificar Upload:</b> Executando um getResult Ã© possÃ­vel verificar se o Upload foi executado ou nÃ£o. Retorna
     * uma string com o caminho e nome do arquivo ou FALSE.
     * @return STRING  = Caminho e Nome do arquivo ou False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um code, um title, um erro e um tipo.
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    /** 
     * @param array $FileAccept
     * @param int $MaxFileSize
     */
    private function saveFile(array $FileAccept, $MaxFileSize) {

        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
        elseif (!in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
            $this->Error = "Tipo de arquivo não suportado. Formato incorreto";
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }
    
    private function CheckFolder($Folder) {
        list($y, $m) = explode('/', date('Y/m'));

        $this->CreateFolder("{$Folder}/");
        $this->CreateFolder("{$Folder}/{$y}/");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = "{$Folder}/{$y}/{$m}/";
    }

    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    private function setFileName() {
        $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');

        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            $FileName = Check::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');
        endif;
        $this->Name = $FileName;
    }

    /**
     * Retorna o tipo da imagem
     * 
     * @return string
     */
    private function TestType() {
        switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                return 'jpg';
            case 'image/png':
            case 'image/x-png':
                return 'png';
        endswitch;
    }

    /**
     * Verifica se a imagem foi criada ou se houve erro!
     * 
     * @param imagecreatetruecolor $NewImage
     */
    private function ValidateImage($NewImage) {
        if (!$NewImage):
            $this->Result = FALSE;
            $this->Error = "Tipo de arquivo inválido, envie imagens JPG ou PNG";
        else:
            $this->Result = $this->Send . $this->Name;
            $this->Error = null;
        endif;
    }

    /**
     * Retorna a imagem redimencionada
     * 
     * @return imagecreatetruecolor
     */
    private function CreateImage() {

        $x = imagesx($this->Image);
        $y = imagesy($this->Image);
        $ImageX = ( $this->Width < $x ? $this->Width : $x);
        $ImageH = ($ImageX * $y) / $x;

        $NewImage = imagecreatetruecolor($ImageX, $ImageH);
        imagesavealpha($NewImage, true);
        imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);

        return $NewImage;
    }

    private function UploadImage() {

        if ($this->TestType() == 'jpg'):
            $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
        elseif ($this->TestType() == 'png'):
            $this->Image = imagecreatefrompng($this->File['tmp_name']);
        endif;

        if (!$this->Image):
            $this->Result = false;
            $this->Error = "Tipo de arquivo inválido, envie imagens JPG ou PNG";
        else:

            $NewImage = $this->CreateImage();

            if ($this->TestType() == 'jpg'):
                imagejpeg($NewImage, self::$BaseDir . $this->Send . $this->Name);
            elseif ($this->TestType() == 'png'):
                imagepng($NewImage, self::$BaseDir . $this->Send . $this->Name);
            endif;

            $this->ValidateImage($NewImage);

            imagedestroy($this->Image);
            imagedestroy($NewImage);
        endif;
    }

    private function MoveFile() {
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
            $this->Result = $this->Send . $this->Name;
            $this->Error = null;
        else:
            $this->Result = false;
            $this->Error = "Erro ao mover o arquivo. Favor tente mais tarde!";
        endif;
    }

}
