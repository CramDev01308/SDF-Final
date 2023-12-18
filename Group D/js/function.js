class Search {
  constructor(inputId) {
    this.inputId = inputId;
    this.inputElement = document.getElementById(inputId);

    this.inputElement.addEventListener('input', this.handleSearch.bind(this));
  }

  handleSearch() {
    const searchTerm = this.inputElement.value.toLowerCase();
    const rows = document.querySelectorAll('.custom-row');

    rows.forEach((row) => {
      const username = row.querySelector('.text-center:nth-child(2)').textContent.toLowerCase();
      const email = row.querySelector('.text-center:nth-child(3)').textContent.toLowerCase();
      const password = row.querySelector('.text-center:nth-child(4)').textContent.toLowerCase();
      const title = row.querySelector('.text-center:nth-child(5)').textContent.toLowerCase();

      if (
        username.includes(searchTerm) ||
        email.includes(searchTerm) ||
        password.includes(searchTerm) ||
        title.includes(searchTerm)
      ) {
        row.style.display = 'table-row';
      } else {
        row.style.display = 'none';
      }
    });
  }
}

class TodoList {
  constructor() {
    this.initEventHandlers();
  }

  initEventHandlers() {
    $(document).ready(() => {
      $('.remove-to-do').click(function () {
        const id = $(this).attr('id');

        $.post(
          'app/remove.php',
          {
            id: id,
          },
          (data) => {
            if (data) {
              $(this).parent().hide(600);
            }
          }
        );
      });

      $('.check-box').click(function (e) {
        const id = $(this).attr('data-todo-id');

        $.post(
          'app/check.php',
          {
            id: id,
          },
          (data) => {
            if (data != 'error') {
              const h2 = $(this).next();
              const editIcon = $(this).siblings('span').find('i');
              if (data === '1') {
                h2.removeClass('checked');
                editIcon.show();
              } else {
                h2.addClass('checked');
                editIcon.hide();
              }
            }
          }
        );
      });
    });
  }
}

class PasswordToggle {
  constructor() {
    this.passwordField = document.querySelector('input[name="password"]');
    this.initEventHandlers();
  }

  initEventHandlers() {
    this.passwordField.addEventListener('click', this.togglePassword.bind(this));
  }

  togglePassword() {
    if (this.passwordField.type === 'password') {
      this.passwordField.type = 'text';
    } else {
      this.passwordField.type = 'password';
    }
  }
}

const search = new Search('searchInput');
const todoList = new TodoList();
const passwordToggle = new PasswordToggle();