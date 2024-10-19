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
document.addEventListener('DOMContentLoaded', () => {
    const userBtn = document.getElementById('view-users-btn');

    if (userBtn) {
        userBtn.addEventListener('click', function (e) {
            e.preventDefault();

            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST', body: new URLSearchParams({
                    action: 'list_user_info',
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let html = '';
                        data.data.fields.forEach(field => {
                            html += `<th>${field}</th>`
                        });
                        document.querySelector("#user-list > thead").innerHTML = '<tr>' + html + '</tr>';
                        html = '';
                        data.data.users.forEach(user => {
                            html += '<tr>' + `<th>${user.name}</th> <th>${user.country}</th>` + '</tr>'
                        });
                        document.querySelector("#user-list > tbody").innerHTML = html;
                    }
                })
        })
    }

})
/* eslint-enable no-console */
