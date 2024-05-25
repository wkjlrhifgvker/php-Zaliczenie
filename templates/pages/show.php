<div class="show">
    <?php $note = $params['note'] ?? null; ?>
    <?php if ($note) : ?>
        <ul>
            <li>Id: <?php echo (int) $note['id'] ?></li>
            <li>Tytul: <?php echo $note['title'] ?></li>
            <li>Opis:<?php echo $note['description'] ?></li>
            <li>Utworzono: <?php echo $note['created'] ?></li>
            <li>
                <a href="/">
                    <button>Powrót do listy notatek</button>
                </a>
            </li>
            <li>
                <a href="/?action=edit&id=<?php echo (int) $note['id'] ?>">
                    <button>Edytuj Notatkę</button>
                </a>
            </li>
            <li>
                    <button>Usuń Notatkę</button>
                </a>
            </li>
        </ul>
        <?php else : ?>
            <div>Brak notatki do wyświetlenia</div>
            <?php endif; ?>
</div>