(() => {
    const links = document.querySelectorAll(".js-alias-links");

    for(const  link of links){
        link.addEventListener("click", () => {
            const text = (link.innerText);
            console.log(text);
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        });
    }
})()
