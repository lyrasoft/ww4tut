const delButtons = document.querySelectorAll<HTMLButtonElement>('button[data-delete]');

for (const button of delButtons) {
  button.addEventListener('click', (e) => {
    deleteItem(button.dataset.delete!);
  });
}

function deleteItem(id: string) {
  if (!confirm('確定要刪除嗎？')) {
    return;
  }

  const form = document.querySelector<HTMLFormElement>('#admin-form')!;
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
