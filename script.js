//檔案連接
document.getElementById('btn1').addEventListener('click', function() {
    window.location.href = 'EnterPic.html';
  });
  document.getElementById('btn2').addEventListener('click', function() {
    window.location.href = 'EnterTxt.html';
  });
  document.getElementById('btn3').addEventListener('click', function() {
    window.location.href = 'ToBuyList.html';
  });
  document.getElementById('btn4').addEventListener('click', function() {
    window.location.href = 'Loupe_html.php';
  });
  document.getElementById('btn5').addEventListener('click', function() {
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


function ToDo() {
  location.href = "Do_Loupe_UnD.php";
}
function Back() {
  location.href = "Loupe_html.php";
}

 //Rewrite

  