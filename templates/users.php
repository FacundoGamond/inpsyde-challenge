<?php // phpcs:disable
/**
 * The template for displaying all users
 */

get_header(); ?>

<section class="inpsyde-challenge">
    <h1 class="inpsyde-challenge__title"><?php esc_html_e('Users Table', 'inpsydechallenge'); ?></h1>
    <div class="inpsyde-challenge__table-wrapper js-inpsyde-challenge">
        <div class="inpsyde-challenge__table-header">
            <span class="inpsyde-challenge__col"><?php esc_html_e('ID', 'inpsydechallenge'); ?></span>
            <span class="inpsyde-challenge__col"><?php esc_html_e('Name', 'inpsydechallenge'); ?></span>
            <span class="inpsyde-challenge__col"><?php esc_html_e('Username', 'inpsydechallenge'); ?></span>
        </div>
    </div>
    <div class="inpsyde-challenge__modal js-user-modal">
        <div class="inpsyde-challenge__modal-wrapper">
            <button class="inpsyde-challenge__modal-closebtn js-user-modal-close">X</button>
            <h4 class="js-user-name"></h4>
            <h5 class="js-user-username"></h5>
            <h6 class="inpsyde-challenge__job js-user-job"></h6>
            <div class="inpsyde-challenge__modal-contact">
                <a class="js-user-website" href="" target="_blank">
                    <?php esc_html_e('Website', 'inpsydechallenge'); ?>
                </a>
                <a class="js-user-phone" href="">
                    <?php esc_html_e('Phone', 'inpsydechallenge'); ?>
                </a>
                <a class="js-user-email" href="">
                    <?php esc_html_e('Email', 'inpsydechallenge'); ?>
                </a>
            </div>
            <p class="inpsyde-challenge__modal-address js-user-address"></p>
        </div>
    </div>
</section>

<?php get_footer(); ?>