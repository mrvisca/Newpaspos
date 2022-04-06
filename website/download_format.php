<?php
    //Menggabungkan dengan file koneksi yang telah kita buat
    include '../settings/database.php';

    session_start();
    if( !isset($_SESSION['role'])){
        echo '<script>window.location.href = "./login.php";</script>';
    }

    $pass=$_SESSION['pass'];
    $user=$_SESSION['user'];
    $role=$_SESSION['role'];
    $id_brand=$_SESSION['id_brand'];
    $nama_brand=$_SESSION['nama_brand'];
    $nama="OWNER";
    if($role=="emp"){//employee
        $id_branch=$_SESSION['id_branch'];
        $fea_kasir=$_SESSION['fea_kasir'];
        $fea_menu=$_SESSION['fea_menu'];
        $fea_pegawai=$_SESSION['fea_pegawai'];
        $nama=$_SESSION['nama'];
    }
    
    // Load library phpspreadsheet
    require '../vendor/autoload.php';
    
    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet
    
    $spreadsheet = new Spreadsheet();
    
    // Set document properties
    $spreadsheet->getProperties()->setCreator('Mr.Visca')
    ->setLastModifiedBy('Paspos.com')
    ->setTitle('Paspos.com')
    ->setSubject('Paspos.com')
    ->setDescription('Paspos.com.')
    ->setKeywords('Paspos.com')
    ->setCategory('Paspos.com');
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

    // $spreadsheet->getActiveSheet()->mergeCells('A17:K17');
    // $styleArrayFooter = [
    //     'font' => [
    //         'bold' => true,
    // 		'size' => 16,
    //     ],
    // ];
    // $spreadsheet->getActiveSheet()->getStyle('A17:K17')->applyFromArray($styleArrayFooter);
    // $spreadsheet->getActiveSheet()->getStyle('A17:K17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    // $spreadsheet->setActiveSheetIndex(0)->setCellValue('A17', 'Format Import data produk');
    // $styleArrayFooter2 = [
    //     'font' => [
    //         'bold' => true,
    // 		'size' => 16,
    //     ],
    // ];
    // $spreadsheet->getActiveSheet()->getStyle('A18:K18')->applyFromArray($styleArrayFooter2);
    // $spreadsheet->getActiveSheet()->getStyle('A18:K18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    // $spreadsheet->setActiveSheetIndex(0)->setCellValue('A18', 'www.paspos.com');
    // $spreadsheet->getActiveSheet()->mergeCells('A18:K18');
    
    //Font Color
    $spreadsheet->getActiveSheet()->getStyle('A1:K1')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
    
    // Background color
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '#FF000000'],
            ],
        ],
    ];

    $styleArray1 = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '#FFFFFFFF'],
            ],
        ],
    ];
    $spreadsheet->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('A2:K11')->applyFromArray($styleArray1);
    $spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('#FF000000');
    
    
    // Header Tabel
    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'NAMA PRODUK')
    ->setCellValue('B1', 'KODE')
    ->setCellValue('C1', 'HARGA JUAL')
    ->setCellValue('D1', 'HARGA BELI')
    ->setCellValue('E1', 'DESKRIPSI')
    ->setCellValue('F1', 'BRAND')
    ->setCellValue('G1', 'ID KATAGORI')
    ->setCellValue('H1', 'ID BRANCH')
    ->setCellValue('I1', 'LINK FOTO')
    ->setCellValue('J1', 'JUMLAH STOCK')
    ->setCellValue('K1', 'BULK STOCK')
    ;
    
    $i=2;
    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A'.$i, '')
    ->setCellValue('B'.$i, '')
    ->setCellValue('C'.$i, '')
    ->setCellValue('D'.$i, '')
    ->setCellValue('E'.$i, '')
    ->setCellValue('F'.$i, $id_brand)
    ->setCellValue('G'.$i, '')
    ->setCellValue('H'.$i, '')
    ->setCellValue('I'.$i, '')
    ->setCellValue('J'.$i, '')
    ->setCellValue('K'.$i, '0')
    ;

    //Font Color Katagori
    $spreadsheet->getActiveSheet()->getStyle('M1:N1')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
    
    // Background color
        $styleArrayKatagori = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '#FF000000'],
                ],
            ],
        ];

        $styleArrayKatagori1 = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '#FFFFFFFF'],
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('M1:N1')->applyFromArray($styleArrayKatagori);
        $spreadsheet->getActiveSheet()->getStyle('M2:N11')->applyFromArray($styleArrayKatagori1);
        $spreadsheet->getActiveSheet()->getStyle('M1:N1')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('#FF000000');
    
    // Header keterangan katagori
    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('M1', 'ID')
    ->setCellValue('N1', 'NAMA KATAGORI');
    
    $i=2;
    $querykatagori = "SELECT * FROM katagori WHERE id_brand='".$id_brand."' LIMIT 10";
    $stmt2 = $koneksi->prepare($querykatagori);
    $stmt2->execute();
    $katagori = $stmt2->get_result();
    while ($row = $katagori->fetch_assoc()) {
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('M'.$i, $row['id'])
        ->setCellValue('N'.$i, $row['nama']);
        $i++;
    }

    //Font Color Branch
    $spreadsheet->getActiveSheet()->getStyle('M14:N14')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
    
    // Background color
        $styleArrayBranch = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '#FF000000'],
                ],
            ],
        ];

        $styleArrayBranch1 = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '#FFFFFFFF'],
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('M14:N14')->applyFromArray($styleArrayBranch);
        $spreadsheet->getActiveSheet()->getStyle('M14:N25')->applyFromArray($styleArrayBranch1);
        $spreadsheet->getActiveSheet()->getStyle('M14:N14')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('#FF000000');
    
    // Header keterangan katagori
    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('M14', 'ID')
    ->setCellValue('N14', 'NAMA BRANCH');
    
    $i=15;
    $querybranch = "SELECT * FROM branch WHERE id_brand='".$id_brand."' LIMIT 10";
    $stmt3 = $koneksi->prepare($querybranch);
    $stmt3->execute();
    $branch = $stmt3->get_result();
    while ($row = $branch->fetch_assoc()) {
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('M'.$i, $row['id'])
        ->setCellValue('N'.$i, $row['nama']);
        $i++;
    }


    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Format Impor Produk');
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);
    
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="file_produk.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0
    
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
?>