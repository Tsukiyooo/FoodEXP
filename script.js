//檔案連接
document.getElementById('btn0').addEventListener('click', function() {
  window.location.href = 'main.html';
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
    window.location.href = 'UserMap.html';
  });


  document.getElementById('bt0').addEventListener('click', function() {
    window.location.href = 'main.html';
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

//EnterPic
function displaySelectedImage(input) {
    var previewImage = document.getElementById('previewImage');
  
    // 檢查是否有選擇的文件
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        // 更新預覽圖片的 src
        previewImage.src = e.target.result;
        // 顯示預覽圖片
        previewImage.style.display = 'block';
      };
  
      // 讀取文件內容
      reader.readAsDataURL(input.files[0]);
    } else {
      // 如果沒有選擇文件，隱藏預覽圖片
      previewImage.style.display = 'none';
    }
  }
        function PicresetForm() {
            // 重置表單（這部分的具體實現可能還需根據你的需求進行調整）
            document.getElementById('photoForm').reset();
            // 隱藏預覽圖片
            document.getElementById('previewImage').style.display = 'none';
          }
          function PicconfirmForm() {
            // 在這裡添加確認表單的操作，根據你的需求進行實現
            alert('表單已確認');
          }

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

    function showConfirmationDialog() {
        var result = confirm("家中尚有相同商品，是否要新增？");
        if (result) {
          
            document.getElementById('submitForm').submit();
        } else {
            window.location.href = "ToBuyINSERT.html";
        }
    }
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

// 確保腳本在 DOM 加載後執行
document.addEventListener("DOMContentLoaded", function() {
  // 獲取圖片和文件輸入框元素
  const profileImage = document.getElementById("profileImage");
  const fileInput = document.getElementById("fileInput");

  // 點擊圖片時觸發文件選擇
  profileImage.addEventListener("click", function() {
      fileInput.click();
  });

  // 當文件選擇完成後，顯示選擇的圖片
  fileInput.addEventListener("change", function() {
      const file = fileInput.files[0];
      if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
              profileImage.src = e.target.result; // 更新圖片為選擇的頭貼
          };
          reader.readAsDataURL(file);
      }
  });
});





