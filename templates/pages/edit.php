<h3>Edycja Notatki</h3>
<div>
    <?php
    $note = $params['note'] ?>
    <?php if (!empty($params['note'])) : ?>
    <form action="/?action=edit" class="note-form" method="post">
        <input type="text" name="id" value="<?php echo $note['id'] ?>" hidden />
        <ul>
            <li>
                <label for="title">Tytuł <span class="required"></span></label>
                <input type="text" name="title" id="title" class="field-long" value="<?php echo $note['title'] ?>">
            </li>
            <li>
                <label for="field5">Treść </label>
                <textarea name="description" id="field5" clss="field-long field-textarea"><?php echo $note['description'] ?></textarea>
            </li>
            <li>
                <input type="submit" value="Edytuj">
            </li>
        </ul>
</form>
<?php else : ?>
    <div>
        Brak notatki do wyświetlenia!
        <a href="/"><button>Powrtót do listy notatek</button></a>
    </div>
    <?php endif; ?>

</div>