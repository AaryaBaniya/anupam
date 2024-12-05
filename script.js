document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab");
  const tabContents = document.querySelectorAll(".tab-content");

  tabs.forEach((tab) => {
    tab.addEventListener("click", (event) => {
      event.preventDefault();

      // Remove 'active' class from all tabs and hide all tab contents
      tabs.forEach((t) => t.classList.remove("active"));
      tabContents.forEach((content) => content.classList.remove("active"));

      // Add 'active' class to the clicked tab
      tab.classList.add("active");

      // Show the corresponding tab content
      const target = tab.getAttribute("data-tab");
      document.getElementById(target).classList.add("active");
    });
  });
});
// const signUpButton=document.getElementById('signUpButton');
// const signInButton=document.getElementById('signInButton');
// const signInForm=document.getElementById('signIn');
// const signUpForm=document.getElementById('signUp');

// signUpButton.addEventListener('click',function(){
//     signInForm.style.display="none";
//     signUpForm.style.display="block";

// })

// signInButton.addEventListener('click',function(){
//     signInForm.style.display="block";
//     signUpForm.style.display="none";
    
// })