<div class="inpsyde-challenge__table">
    <?php foreach ($users as $user) : ?>
        <article class="inpsyde-challenge__table-article">
            <a class="inpsyde-challenge__id" href="<?php echo esc_url("https://jsonplaceholder.typicode.com/users/{$user['id']}"); ?>" data-id="<?php echo esc_attr($user['id']); ?>">
                <?php echo esc_html($user['id']) ?>
            </a>
            <a class="inpsyde-challenge__name" href="<?php echo esc_url("https://jsonplaceholder.typicode.com/users/{$user['id']}"); ?>" data-id="<?php echo esc_attr($user['id']); ?>">
                <?php echo esc_html($user['name']); ?>
            </a>
            <a class="inpsyde-challenge__username" href="<?php echo esc_url("https://jsonplaceholder.typicode.com/users/{$user['id']}"); ?>" data-id="<?php echo esc_attr($user['id']); ?>">
                <?php echo esc_html($user['username']); ?>
            </a>
        </article>

    <?php endforeach; ?>
    <div>