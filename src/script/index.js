const handleCounter=()=>{
    let currentValue = 0;
    const increment=()=>currentValue+=1;
    const decrement=()=>currentValue-=1;
    const getValue=()=>currentValue;
    return {
        increment,
        decrement,
        getValue
    }
}

const counter = handleCounter();

const addToCart=(inputID)=>{
    const ul = document.getElementById("cartList");
    let li = document.createElement("li");
    li.className = `${inputID}-li`;
    li.innerHTML = createItem(inputID);
    ul.appendChild(li);
    document.getElementById("cartAmountID").innerHTML = counter.increment();
    changeItemState(inputID.id,true);
    openCloseSlider();
}

const createItem=(inputID)=>{
    const name = inputID.id;
    const actualName = document.querySelector(`#${name}ID`).textContent;
    const price = document.getElementById(`${name}_price`).innerText;
    const amount = inputID.value;
    const total = parseInt(amount)*parseInt(price);
    return `
        <img loading="lazy" src="src/assets/${name}.png" alt="${actualName}"> 
        <div class="flex-wrap">
        <div class="flex-box-cart">
            <p class="item_name">${actualName}</p>
            <button class="exit-button" onclick="removeItem(${name})" aria-label="remove item from cart" type="button">x</button>
        </div>
        <div class="item_price">Cijena: <span class="weight">${total},00 kn</span></div>
        <div class="item_quantity">Količina: <span class="weight">${amount}</span></div>
        </div>
  `
}

const toggleCart=()=>{
    const cart = document.getElementById("cart");
    if(cart.style.opacity === "1"){
        cart.style = "opacity:0;";
    }else{
        cart.style = "opacity:1;";
    }
}

const changeItemState=(name,state)=>{
    document.getElementById(`${name}_button`).disabled = state;
}

const removeitem=(name)=>{
    const item = document.getElementsByClassName(`${name.id}-li`);
    item[0].remove();
    document.getElementById("cartAmountID").innerHTML = counter.decrement();
    changeItemState(name.id,false);
}