<?php
// toutes les données pour l'export (pas seulement la page courante)
$tousExport = $etudiantRepo->findEtudiantsAndSection();
$etudiantsJson = json_encode(array_map(fn($e) => [
    'ID'       => $e['id'],
    'Nom'      => $e['name'],
    'Birthday' => $e['date_de_naiss'],
    'Section'  => $e['section_nom'] ?? 'N/A',
], $tousExport));
?>
<script>
const data    = <?= $etudiantsJson ?>;
const cols    = ['ID', 'Nom', 'Birthday', 'Section'];
const fichier = 'etudiants';

// ── COPY ──
document.getElementById('btn-copy').addEventListener('click', () => {
    const texte = [cols.join('\t')]
        .concat(data.map(r => cols.map(c => r[c] ?? '').join('\t')))
        .join('\n');
    navigator.clipboard.writeText(texte)
        .then(() => alert('✅ Copié dans le presse-papiers !'))
        .catch(() => alert('❌ Echec de la copie.'));
});

// ── CSV ──
document.getElementById('btn-csv').addEventListener('click', () => {
    const contenu = [cols.join(',')]
        .concat(data.map(r => cols.map(c => '"' + (r[c] ?? '') + '"').join(',')))
        .join('\n');
    const blob = new Blob(['\uFEFF' + contenu], { type: 'text/csv;charset=utf-8;' });
    const a    = Object.assign(document.createElement('a'), {
        href: URL.createObjectURL(blob),
        download: fichier + '.csv'
    });
    a.click();
    URL.revokeObjectURL(a.href);
});

// ── EXCEL ──
document.getElementById('btn-excel').addEventListener('click', () => {
    const ws = XLSX.utils.json_to_sheet(data, { header: cols });

    // Largeur des colonnes
    ws['!cols'] = [{ wch: 6 }, { wch: 20 }, { wch: 14 }, { wch: 16 }];

    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Étudiants');
    XLSX.writeFile(wb, fichier + '.xlsx');
});

// ── PDF ──
document.getElementById('btn-pdf').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Titre
    doc.setFontSize(14);
    doc.setTextColor(45, 74, 122); // --navy
    doc.text('Liste des étudiants', 14, 15);

    // Sous-titre date
    doc.setFontSize(9);
    doc.setTextColor(138, 147, 176); // --muted
    doc.text('Exporté le ' + new Date().toLocaleDateString('fr-FR'), 14, 22);

    // Tableau
    doc.autoTable({
        head: [cols],
        body: data.map(r => cols.map(c => r[c] ?? '')),
        startY: 27,
        styles:      { fontSize: 9, cellPadding: 4 },
        headStyles:  { fillColor: [45, 74, 122], textColor: 255, fontStyle: 'bold' },
        alternateRowStyles: { fillColor: [244, 246, 250] },
        tableLineColor: [221, 227, 239],
        tableLineWidth: 0.1,
    });

    // Footer
    const pages = doc.internal.getNumberOfPages();
    for (let i = 1; i <= pages; i++) {
        doc.setPage(i);
        doc.setFontSize(8);
        doc.setTextColor(138, 147, 176);
        doc.text('Page ' + i + ' / ' + pages,
            doc.internal.pageSize.getWidth() - 20, 
            doc.internal.pageSize.getHeight() - 8);
    }

    doc.save(fichier + '.pdf');
});
</script>