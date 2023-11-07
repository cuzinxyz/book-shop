// RESET BẢN THÂN
$(".layout-2").hide()
function toggleLayout(sectionId) {
    $(".layout-2").hide();
    $("#" + sectionId).find(".layout-2").show();
}
$(".sbdashboard").on("click", function () {
    toggleLayout("dashboard");
});
$(".sbbooks").on("click", function () {
    toggleLayout("books");
});
$(".sbauthors").on("click", function () {
    toggleLayout("authors");
});
$(".sbusers").on("click", function () {
    toggleLayout("users");
});
$(".sborder").on("click", function () {
    toggleLayout("order");
});

// RESET BẢN THÂN


const authorList = document.querySelector('.authors');
const btnAddAuthor = document.querySelector('#addauthor');
const userList = document.querySelector('.users');
const btnAddUser = document.querySelector('#adduser');
const bookList = document.querySelector('.books');
const btnAddBook = document.querySelector('#addbook');


async function loadAuthors() {
    const response = await fetch("/admin/authors");
    const authors = await response.json();
    console.log(authors);

    showAuthors(authors);
}
async function showAuthors(data) {
    authorList.innerHTML = '<li>list</li>';
    const datalist = await data.map((author, index) => {
        return `
            <li class="posts">
            <span class="count">${author.id}</span>
            <a onclick="removeAuthor(${author.id})">${author.name}</a>
            </li>
        `
    }).join("")
    authorList.insertAdjacentHTML('beforeend', datalist);
}
async function removeAuthor(id) {
    const res = await axios.delete(`/admin/authors/${id}`);

    console.log(res);

    loadAuthors()
}
document.querySelector("#addauthor").addEventListener("click", function (e) {
    e.preventDefault();
    axios.post('/admin/authors', {
        name: document.querySelector("#authorname").value,
    })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    loadAuthors()
})





async function loadUsers() {
    const response = await fetch("/admin/users");
    const users = await response.json();
    console.log(users);

    showUsers(users);
}
async function showUsers(data) {
    userList.innerHTML = '<li>list</li>';
    const datalist = await data.map((user, index) => {
        return `
            <li class="posts">
            <span class="count">${user.id}</span>
            <a onclick="removeUser(${user.id})">${user.name}</a>
            </li>
        `
    }).join("")
    userList.insertAdjacentHTML('beforeend', datalist);
}
async function removeUser(id) {
    const res = await axios.delete(`/admin/users/${id}`);

    console.log(res);

    loadUsers()
}
document.querySelector("#adduser").addEventListener("click", function (e) {
    e.preventDefault();
    axios.post('/admin/users', {
        name: document.querySelector("#username").value,
        email: document.querySelector("#email").value,
        password: document.querySelector("#password").value,
    })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    loadUsers()

    document.querySelector("#username").value = ''
    document.querySelector("#email").value = ''
    document.querySelector("#password").value = ''
})




async function loadBooks() {
    const response = await fetch("/admin/books");
    const books = await response.json();
    console.log(books);

    showBooks(books);
}
async function showBooks(data) {
    const responseAuthor = await fetch("/admin/authors");
    const authors = await responseAuthor.json();
    console.log(authors);

    const authorlist = await authors.map((author, index) => {
        return `<option value="${author.id}">${author.name}</option>`
    }).join("")
    document.querySelector("#author").innerHTML = authorlist;

    bookList.innerHTML = '<li>list</li>';
    const datalist = await data.map((book, index) => {
        return `
            <li class="posts">
            <span class="count">${book.id}</span>
            <a onclick="removeBook(${book.id})">${book.title}</a>
            </li>
        `
    }).join("")
    bookList.insertAdjacentHTML('beforeend', datalist);
}
async function removeBook(id) {
    const res = await axios.delete(`/admin/books/${id}`);

    console.log(res);

    loadBooks()
}
document.querySelector("#addbook").addEventListener("click", function (e) {
    e.preventDefault();
    axios.post('/admin/books', {
        title: document.querySelector("#bookname").value,
        author_id: document.querySelector("#author").value,
        price: document.querySelector("#bookprice").value,
        published_date: document.querySelector("#published_date").value,
        cover: document.querySelector("#cover").files[0],
        publish: document.querySelector("#publish").value,
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    loadBooks()

    // document.querySelector("#bookname").value = ''
    // document.querySelector("#bookprice").value = ''
    // document.querySelector("#published_date").value = ''
})






