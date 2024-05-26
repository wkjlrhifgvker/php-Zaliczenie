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
                <form action="/?action=delete" class="note-form" method="post">
                <input type="text" name="id" value="<?php echo $note['id'] ?>" hidden />
                <input type="submit" value="<?php echo $note['id'] ?>">
                </a>
                </form>
            </li>
           
        </ul>
        <?php else : ?>
            <div>Brak notatki do wyświetlenia</div>
            <?php endif; ?>
</div>