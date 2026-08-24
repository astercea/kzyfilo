<?php
/**
 * kzyfilo — Admin SSS Yönetimi (admin/sss.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$faqsData = loadData('faqs.php');
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Sıkça Sorulan Sorular (SSS) Yönetimi</h1>
        <p class="text-sm text-muted">Kategori bazlı soru ve cevap listesi</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni soru ekleme modalı tetiklendi')">+ Yeni Soru Ekle</button>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Soru</th>
                <th>Cevap Özeti</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($faqsData as $catKey => $cat): ?>
                <?php foreach ($cat['items'] as $item): ?>
                    <tr>
                        <td><span class="badge badge-light"><?php echo esc($cat['category_name']); ?></span></td>
                        <td><strong><?php echo esc($item['question']); ?></strong></td>
                        <td class="text-xs text-muted"><?php echo mb_substr($item['answer'], 0, 80) . '...'; ?></td>
                        <td>
                            <button class="btn btn-secondary btn-sm" onclick="adminNotice('Soru düzenleme formu')">Düzenle</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
