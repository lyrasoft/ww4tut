// src/Module/Admin/Article/assets/article-list.js

function deleteItem(id) {
  if (!confirm('確定要刪除嗎？')) {
    return;
  }

  const form = document.querySelector('#admin-form');
  form.method = 'post';

  const idInput = document.createElement('input');
  idInput.value = id;
  idInput.name = 'id';
  idInput.type = 'hidden';

  form.appendChild(idInput);

  const methodInput = document.createElement('input');
  methodInput.value = 'DELETE';
  methodInput.name = '_method';
  methodInput.type = 'hidden';

  form.appendChild(methodInput);

  form.submit();
}
