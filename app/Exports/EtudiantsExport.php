<?php

namespace App\Exports;

use App\Models\Etudiant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class EtudiantsExport implements FromCollection, WithHeadings, WithStyles, WithEvents, ShouldAutoSize
{
    public function collection()
    {
        return Etudiant::with(['user', 'encadrant'])
            ->get()
            ->map(function($etudiant) {
                return [
                    'Nom' => $etudiant->user->name,
                    'Email' => $etudiant->user->email,
                    'Encadrant' => $etudiant->encadrant ? $etudiant->encadrant->name : 'Non assigné',
                    'Sujet' => $etudiant->sujet,
                    'Rapport' => $etudiant->rapport ? 'Oui' : 'Non',
                    'Présentation' => $etudiant->presentation ? 'Oui' : 'Non',
                    'Statut Rapport' => $this->formatStatus($etudiant->statut_rapport ?? 'En attente'),
                    'Statut Présentation' => $this->formatStatus($etudiant->statut_presentation ?? 'En attente'),
                    'Validation Admin' => $this->formatStatus($etudiant->validation_admin ?? 'En attente'),
                ];
            });
    }

    private function formatStatus($status)
    {
        $statusMap = [
            'validé' => '✅ Validé',
            'refusé' => '❌ Refusé',
            'en attente' => '⏳ En attente'
        ];
        
        return $statusMap[strtolower($status)] ?? $status;
    }

    public function headings(): array
    {
        return [
            'NOM ÉTUDIANT',
            'EMAIL',
            'ENCADRANT',
            'SUJET DU PROJET',
            'RAPPORT SOUMIS',
            'PRÉSENTATION SOUMISE',
            'STATUT RAPPORT',
            'STATUT PRÉSENTATION',
            'VALIDATION ADMINISTRATEUR',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Styles de base pour toute la feuille
        $sheet->getParent()->getDefaultStyle()->applyFromArray([
            'font' => [
                'name' => 'Arial',
                'size' => 10,
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Style pour l'en-tête
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2C3E50'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '1A5276'],
                ],
            ],
        ]);

        // Style pour les lignes de données
        $sheet->getStyle('A2:I'.$sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'EEEEEE'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'wrapText' => true,
            ],
        ]);

        // Style alterné pour les lignes
        for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {
            $fillColor = $row % 2 == 0 ? 'FFFFFF' : 'F8F9FA';
            $sheet->getStyle('A'.$row.':I'.$row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB($fillColor);
        }

        // Format conditionnel pour les statuts
        $conditionalStyles = [
            'validé' => '4CAF50', // Vert
            'refusé' => 'E74C3C', // Rouge
            'en attente' => 'F39C12', // Orange
        ];

        foreach (['G', 'H', 'I'] as $column) {
            foreach ($conditionalStyles as $text => $color) {
                $sheet->getStyle($column.'2:'.$column.$sheet->getHighestRow())
                    ->getFont()
                    ->getColor()
                    ->setRGB($text === 'validé' ? 'FFFFFF' : '000000');
                
                $sheet->getStyle($column.'2:'.$column.$sheet->getHighestRow())
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB($color);
            }
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Ajuster la hauteur des lignes
                $sheet->getDefaultRowDimension()->setRowHeight(20);
                $sheet->getRowDimension(1)->setRowHeight(25);

                // Centrer les colonnes spécifiques
                $sheet->getStyle('E2:I'.$sheet->getHighestRow())->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Ajouter un filtre automatique
                $sheet->setAutoFilter('A1:I1');

                // Geler la première ligne (en-tête)
                $sheet->freezePane('A2');

                // Ajouter une bordure autour de tout le tableau
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle('A1:I'.$lastRow)->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => '2C3E50'],
                        ],
                    ],
                ]);
            },
        ];
    }
}