var person = {name:"John", age:30, city:"New York"};

document.getElementById("demo").innerHTML =
person.name + "," + person.age + "," + person.city;


const grocery_list = {
  "Banana": { category: "produce", price: 5.99 },
  "Chocolate": { category: "candy", price: 2.75 },
  "Wheat Bread": { category: "grains and breads", price: 2.99 }
};

// since "grocery_list" is an object (not an array) we have do Object.keys()
var generatedHtml = Object.keys(grocery_list).reduce((accum, currKey) => accum +
  `<div class="grocery_item">
    <div class="item">${currKey}</div>
    <div class="category">${grocery_list[currKey].category}</div>
    <div class="price">${grocery_list[currKey].price}</div>
  </div>`, '');

document.getElementById('container').innerHTML = generatedHtml;


function displayProfileInfo() {
  document.getElementById("username").value = username;
}