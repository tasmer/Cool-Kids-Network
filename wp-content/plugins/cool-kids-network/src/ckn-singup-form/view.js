/**
 * Use this file for JavaScript code that you want to run in the front-end 
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any 
 * JavaScript running in the front-end, then you should delete this file and remove 
 * the `viewScript` property from `block.json`. 
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */
 
/* eslint-disable no-console */

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#cnk_register');
    if( form ) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('cnk_email').value;
            const nonce = document.getElementById('security_cool_kid').value;
            const message = document.getElementById('cnk_message');

            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'register_user',
                    email: email,
                    'security_cool_kid': nonce
                }),
            }).then(response => response.json()).then(json => {
                if(json.success) {
                    message.innerHTML = '<p class="notification-message">' + json.data.message + '</p>';

                } else {
                    message.innerHTML = '<p class="notification-message error">' + json.data.message + '</p>';
                }
            }).catch(error => console.error('Erreur :', error));
        })
    }
})

/* eslint-enable no-console */
