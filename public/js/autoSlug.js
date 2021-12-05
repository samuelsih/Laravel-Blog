const title = document.querySelector("#title");
const slug = document.querySelector("#slug");

const urlNow = window.location.href;
const splitURL = urlNow.split("/");
const username = splitURL[4];

console.log(urlNow);

const urlTarget = new URL(
    `http://127.0.0.1:8000/users/${username}/posts/make-slug`
);
urlTarget.searchParams.append("title", title.value);

title.addEventListener("change", async () => {
    try {
        const fetchData = await fetch(urlTarget);

        const response = await fetchData.json();

        console.log(response);

    } catch (error) {
        console.error(error);
    }
});
