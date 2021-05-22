const handleCounter = () => {
  let currentValue = 0;
  const increment = () => currentValue += 1;
  const decrement = () => currentValue -= 1;
  const getValue = () => currentValue;
  return {
    increment,
    decrement,
    getValue,
  };
}

const translateItems = (translateY) => {
  const list = Array.from(document.getElementById("cartList").children);
  list.forEach((el)=>{
      el.style=`transform: translateY(${translateY}); transition: all 1s;`
  })
}

const listeners = ()=>{
  let slideUpListener;
  let slideDownListener;

  const attachSlideUpListener=()=>{
    if(!slideUpListener){
      slideUpListener = document.getElementById("slideUpButton").addEventListener("click",()=>translateItems('0px'));
    }
  }
  const attachSlideDownListener=()=>{
    if(!slideDownListener){
      slideDownListener = document.getElementById("slideDownButton").addEventListener("click",()=>{
        const currentWidth = window.innerWidth;
        const translationKeys = Object.keys(translateValues);
        const translationValues = Object.values(translateValues);
        for(let i = 0;i<translationKeys.length;i++){
          if(currentWidth<=translationKeys[i]){
            translateItems(`${translationValues[i].translateY}`);
            break;
          }
        }
      })
    }
  }

  const killListeners=()=>{
    if(slideUpListener && slideDownListener){
      slideUpListener.removeEventListener("click",translateItems);
      slideDownListener.removeEventListener("click",translateItems)
    }
  }
  return {
    attachSlideDownListener,
    attachSlideUpListener,
    killListeners,
  }

}

const counter = handleCounter();
const evenetListeners = listeners();

const translateValues={
  650:{
    translateY:'-50px'
  },
  921:{
    translateY:'-80px'
  },
  2000:{
    translateY:'-110px'
  }
}


const addToCart=(inputID)=>{
    const ul = document.getElementById("cartList");
    let li = document.createElement("li")
    li.className = `${inputID.id}-li`
    li.innerHTML = createItem(inputID);
    ul.appendChild(li)
    document.getElementById('cartAmountID').innerHTML = counter.increment();
    changeItemState(inputID.id,true);
    openCloseSlider();
}

const changeItemState=(name,state)=>{
    document.getElementById(`${name}_button`).disabled = state;
}

const createItem=(inputID)=>{
  const name = inputID.id;
  const actualName = document.querySelector(`#${name}ID`).textContent;
  const price = document.getElementById(`${name}_price`).innerText;
  const amount = inputID.value;
  const total = parseInt(amount) * parseInt(price);
  return `
    <img loading="lazy" src="src/assets/${name}.png" alt="${actualName}"> 
    <div class="flex-wrap">
      <div class="flex-box-cart">
        <p class="item_name">${actualName}</p>
        <button class="exit-button" onclick="removeItem(${name})" aria-label="remove item from cart" type="button">x</button>
      </div>
    <p class="item_price">Cijena: <span class="weight">${total},00 kn</span></p>
    <p class="item_quantity">Količina: <span class="weight">${amount}</span></p>
    </div>
  `
}

const openCloseSlider=()=>{
  const counterValue = counter.getValue();
  if(counterValue>3){
      document.getElementById("slideDownButton").style = "display:inline;"
      document.getElementById("slideUpButton").style = "display:inline;"
      evenetListeners.attachSlideDownListener();
      evenetListeners.attachSlideUpListener();
  }else{
      document.getElementById("slideDownButton").style = "display:none;"
      document.getElementById("slideUpButton").style = "display:none;"
      evenetListeners.killListeners()
  }
}

const toggleCart=()=>{
  const cart = document.getElementById("cart");
  if(cart.style.opacity === "1"){
    cart.style="opacity:0;"
  }else{
    cart.style="opacity:1;"
  }
}

const removeItem=(name)=>{
  const item = document.getElementsByClassName(`${name.id}-li`);
  item[0].style = "transform: translateX(-350px); transition: all 1s;"
  window.setTimeout(()=>{
    item[0].remove();
    document.getElementById('cartAmountID').innerHTML = counter.decrement();
    openCloseSlider();
    translateItems('0px')
    changeItemState(name.id,false);
  },700)
  
}