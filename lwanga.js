document.addEventListener("DOMContentLoaded", function(){

    /* =====================
       SEARCH FUNCTION
    ====================== */

    const searchBtn = document.getElementById("searchBtn");
    const searchBox = document.getElementById("searchBox");

    if(searchBtn && searchBox){
        searchBtn.addEventListener("click", function(){
            searchBox.classList.toggle("hidden");
        });
    }

    const runSearch = document.getElementById("runSearch");
    const searchInput = document.getElementById("searchInput");

    function searchSite(){

        const keyword = searchInput.value.toLowerCase().trim();

        if(keyword === ""){
            alert("Please enter a search term");
            return;
        }

        const sections = document.querySelectorAll("section");

        let found = false;

        sections.forEach(section => {

            section.style.backgroundColor = "";

            if(section.textContent.toLowerCase().includes(keyword) && !found){

                section.scrollIntoView({
                    behavior:"smooth",
                    block:"center"
                });

                section.style.backgroundColor = "#fff3a0";

                found = true;
            }
        });

        if(!found){
            alert("No results found");
        }
    }

    if(runSearch){
        runSearch.addEventListener("click", searchSite);
    }

    if(searchInput){
        searchInput.addEventListener("keypress", function(e){
            if(e.key === "Enter"){
                searchSite();
            }
        });
    }


    /* =====================
       HAMBURGER MENU
    ====================== */

    const menuBtn = document.getElementById("menuBtn");
    const navList = document.getElementById("nav-list");

    if(menuBtn && navList){
        menuBtn.addEventListener("click", function(){
            navList.classList.toggle("show");
        });

        document.querySelectorAll("#nav-list a").forEach(link => {
            link.addEventListener("click", function(){
                navList.classList.remove("show");
            });
        });
    }
document.addEventListener("click", function(e){
    if(
        !navList.contains(e.target) &&
        e.target !== menuBtn
    ){
        navList.classList.remove("show");
    }
});

    /* =====================
       FORM FUNCTION (NEW)
    ====================== */

    const form = document.getElementById("admissionForm");

    if(form){

        form.addEventListener("submit", function(e){
            e.preventDefault();

            const name = document.getElementById("name")?.value;
            const dob = document.getElementById("dob")?.value;
            const school = document.getElementById("school")?.value;
            const parent = document.getElementById("parent")?.value;
            const phone = document.getElementById("phone")?.value;

            const data = {
                name,
                dob,
                school,
                parent,
                phone
            };

            localStorage.setItem("admissionData", JSON.stringify(data));

            const msg = document.getElementById("successMsg");
            if(msg){
                msg.innerText = "Application submitted successfully!";
                msg.style.color = "green";
            }

            form.reset();
        });
    }


    /* =====================
       DOWNLOAD FORM DATA
    ====================== */

    window.downloadForm = function(){

        const data = localStorage.getItem("admissionData");

        if(!data){
            alert("No form data found!");
            return;
        }

        const blob = new Blob([data], {type:"text/plain"});
        const link = document.createElement("a");

        link.href = URL.createObjectURL(blob);
        link.download = "admission-data.txt";

        link.click();
    };

});
const menuBtn = document.getElementById("menuBtn");
const navList = document.getElementById("nav-list");
