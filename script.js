//檔案連接
document.getElementById('btn0').addEventListener('click', function() {
  window.location.href = 'main.php';
});
document.getElementById('btn1').addEventListener('click', function() {
    window.location.href = 'EnterPic_html.php';
  });
  document.getElementById('btn2').addEventListener('click', function() {
    window.location.href = 'EnterTxt.html';
  });
  document.getElementById('btn3').addEventListener('click', function() {
    window.location.href = 'ToBuyList_html.php';
  });
  document.getElementById('btn4').addEventListener('click', function() {
    window.location.href = 'Loupe_html.php';
  });
  document.getElementById('btn5').addEventListener('click', function() {
    window.location.href = 'if sign out.php';
  });
  document.getElementById('btn6').addEventListener('click', function() {
    window.location.href = 'UserMap.html';
  });



  document.getElementById('bt0').addEventListener('click', function() {
    window.location.href = 'main.php';
  });
  document.getElementById('bt1').addEventListener('click', function() {
      window.location.href = 'EnterPic_html.php';
    });
    document.getElementById('bt2').addEventListener('click', function() {
      window.location.href = 'EnterTxt.html';
    });
    document.getElementById('bt3').addEventListener('click', function() {
      window.location.href = 'ToBuyList_html.php';
    });
    document.getElementById('bt4').addEventListener('click', function() {
      window.location.href = 'Loupe_html.php';
    });
    document.getElementById('bt5').addEventListener('click', function() {
      window.location.href = 'UserMap.html';
    });
    document.getElementById('bt6').addEventListener('click', function() {
      window.location.href = 'if sign out.php';
    });

// EnterTxt
function TxtresetForm() {
    document.getElementById("productForm").reset();
}

function TxtsubmitForm() {
    
}

function Rewrite(id, currentName, currentDate) {
  var newName = prompt("請輸入新的品名", currentName);
  if (newName === null) {
    newName = currentName;
}
  var newDate = prompt("請輸入新的日期", currentDate);
  if (newDate === null) {
    newDate = currentDate;
}

  location.href = "Lupdate.php?id="+ id +"&Newname="+ newName + "&Newdate=" + newDate;
 } 
 function SRewrite(id, currentName, currentDate) {
  var newName = prompt("請輸入新的品名", currentName);
  if (newName === null) {
    newName = currentName;
}
  var newDate = prompt("請輸入新的日期", currentDate);
  if (newDate === null) {
    newDate = currentDate;
}

  location.href = "LSupdate.php?id="+ id +"&Newname="+ newName + "&Newdate=" + newDate;
 } 

function ToDo() {
  location.href = "Do_Loupe_UnD.php";
}
function ToDoSel() {
  location.href = "Lselect_UnD.php?productName=" ;
}
function Back() {
  location.href = "Loupe_html.php";
}

function ToSearch() {
  var productName = prompt("請輸入想找尋的產品名稱：");
  // 檢查使用者是否輸入了值
  if (productName !== null && productName !== "") {
      // 將輸入的產品名稱傳遞給後端處理
      location.href = "Lselect.php?productName=" + encodeURIComponent(productName);
  }
}
 //Rewrite
 function addBuy() {
  location.href = "ToBuyINSERT.html";
}
function backtolist() {
  location.href = "ToBuyList_html.php";
}

function TBRewrite(id, currentName, currentquantity,currentremark) {
  var newName = prompt("請輸入新的品名", currentName);
  if (newName === null) {
    newName = currentName;
}
  var newquantity = prompt("請輸入新的數量", currentquantity);
  if (newquantity === null) {
    newquantity = currentquantity;
}
var newremark = prompt("請輸入新的備註", currentremark);
  if (newremark === null) {
    newremark = currentremark;
}
  location.href = "TBupdate.php?id=" + id + "&newName=" + newName + "&newquantity=" + newquantity + "&newremark=" + newremark;
 } 

 function searchBuy() {
  var TBproductName = prompt("請輸入要尋找的產品名稱：");
  // 檢查使用者是否有輸入值
  if (TBproductName !== null && TBproductName !== "") {
      // 將輸入的產品名稱傳遞至後端處理
      location.href = "TBselect.php?TBproductName=" + encodeURIComponent(TBproductName);
  }
}

function changeRowColor(checkbox) {
  if (checkbox.checked) {
      checkbox.parentNode.parentNode.classList.add('checked'); // 添加背景色样式
  } else {
      checkbox.parentNode.parentNode.classList.remove('checked'); // 移除背景色样式
  }
}
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(function (checkbox) {
    var checkboxId = checkbox.getAttribute('data-id');
    var checked = localStorage.getItem('checkbox_' + checkboxId);
    if (checked === 'true') {
        checkbox.checked = true;
        checkbox.parentNode.parentNode.classList.add('checked'); // 添加背景色样式
    }
});

// 为每个 checkbox 添加事件监听器，保存状态到本地存储
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        var checkboxId = this.getAttribute('data-id');
        localStorage.setItem('checkbox_' + checkboxId, this.checked);
        if (this.checked) {
            this.parentNode.parentNode.classList.add('checked'); // 添加背景色样式
        } else {
            this.parentNode.parentNode.classList.remove('checked'); // 移除背景色样式
        }
    });
});
//ToBuyINSERT.php

    
//Loupe_html.php
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('kind').addEventListener('change', updateProducts);
  document.getElementById('sort').addEventListener('change', updateProducts);

  function updateProducts() {
      const kind = document.getElementById('kind').value;
      const sort = document.getElementById('sort').value || 'asc'; // 默認排序為 ASC

      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'fetch_products.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              document.getElementById('product-list').innerHTML = xhr.responseText;
          }
      };
      xhr.send(`kind=${encodeURIComponent(kind)}&sort=${encodeURIComponent(sort)}`);
  }
});

//history
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('kind').addEventListener('change', updateProducts);
  document.getElementById('sort').addEventListener('change', updateProducts);

  function updateProducts() {
      const kind = document.getElementById('kind').value;
      const sort = document.getElementById('sort').value || 'asc';

      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'exp_fetch_products.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              document.getElementById('ex-product-list').innerHTML = xhr.responseText;
          }
      };
      xhr.send(`kind=${encodeURIComponent(kind)}&sort=${encodeURIComponent(sort)}`);
  }
});
//TOP錨點
  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }
//EnterTxt date
var today = new Date();
    
// 格式化日期為 YYYY-MM-DD
today.setDate(today.getDate() + 3);
var day = String(today.getDate()).padStart(2, '0');
var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
var year = today.getFullYear();

// 將日期組合為 YYYY-MM-DD 格式
var todayDate = year + '-' + month + '-' + day;

// 設定 input 的預設值為今日日期
document.getElementById('expiryDate').value = todayDate;


//ToBuyList-more
function toggleMenu(button) {
  var menuOptions = button.nextElementSibling; // 選擇後面的選單
  if (menuOptions.style.display === "none" || menuOptions.style.display === "") {
    menuOptions.style.display = "block"; // 顯示選單
  } else {
    menuOptions.style.display = "none"; // 隱藏選單
  }
}

// 點擊頁面其他部分時隱藏選單
window.addEventListener("click", function(event) {
  var menus = document.querySelectorAll('.menu-options');
  menus.forEach(function(menu) {
    if (!event.target.closest('.action-menu')) {
      menu.style.display = "none"; // 點擊其他區域時隱藏所有選單
    }
  });
});

//登出
function Signout() {
  if (confirm('確定要登出嗎？') == true) {
    window.location.href = 'Sign out.php';
  } else {
      // document.getElementById('showtxt').innerHTML = '您已取消確認';
      history.back();
  }
};

// 監聽圖片的點擊事件，當點擊圖片時觸發文件上傳選擇
document.getElementById('profileImage').addEventListener('click', function() {
  document.getElementById('fileInput').click(); // 模擬點擊隱藏的文件上傳輸入框
});

// 監聽文件輸入的變化事件，當選擇文件時更換圖片
document.getElementById('fileInput').addEventListener('change', function(event) {
  const file = event.target.files[0]; // 獲取所選擇的文件
  if (file) {
      const reader = new FileReader(); // 創建 FileReader 來讀取文件
      reader.onload = function(e) {
          document.getElementById('profileImage').src = e.target.result; // 將圖片顯示為所選文件
      };
      reader.readAsDataURL(file); // 讀取文件為 Data URL
  }
});


// Example using Firebase SDK
import { getToken } from 'firebase/messaging';
import { messaging } from './firebase-config'; // 初始化 Firebase 项目

getToken(messaging, { vapidKey: 'BPnrFDwLLZC7eVnNK2DTw5PgCAKVKNlSqLc6GhaZ86Bjo2b5L9lPnQh-3AEwDOUy3Ee1gJUbofiKx83obSteL5I' }).then((currentToken) => {
  if (currentToken) {
    console.log('FCM Device Token:', currentToken);
    // 将 token 存入数据库，关联到用户
  } else {
    console.log('无法获取 Token。检查通知权限');
  }
}).catch((err) => {
  console.log('获取 Token 出错: ', err);
});




