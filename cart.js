
function showCart()
{
   var cartlist= document.getElementById("cart-list");

   if(cartlist.style.display=="none" || cartlist.style.display=='')
   {
    var req=new Request("ajax/get-cart.php");
    fetch(req)
        .then((r)=>r.text())
        .then((t)=>{
            cartlist.innerHTML=t;
        });
    cartlist.style.display="block";
   }
   else
   {
    cartlist.style.display="none";
   }

}


function searchProduct(e)
                    {
                        e.preventDefault();//Berhentikan sumbit! 
                            //Ini prepare query param? query=<something>&search=ini%20contoh
                        var query=new URLSearchParams();
                        query.append("query",document.getElementById("textSearch").value);
                        query.append("search","ini contoh");
                        var request=new Request("ajax-product.php?"+query.toString(),{method:"GET"});

                        fetch(request)
                            .then((resp)=>resp.json())
                            .then((obj)=>{
                                var html ="<div class = 'row'>";
                                var i=1;
                                
                                obj.forEach(el => {
                                    if(i%4==0)html+="<div class='row'>";
                                html +=`<div class="item">
                                <h4>${el.name}</h4>
                                <h6>Harga : Rp. <span class="harga">${el.price}</span></h6>
                                <input type="number" name="jumlah"> <br/>
                                <button onclick="addToCart(event,'${el.id}')">Add To Cart</button>
                            </div>`;

                                    if(i%3==0) html+="</div>";
                                    i+=1;
                                });

                                if(obj.length<=0)
                                {
                                    html="<div><i>There are no such data!</i></div>";
                                }
                               document.getElementById("catalog-list").innerHTML=html;
                               // document.getElementById("searchForm").submit();
                             
                            });
                    }

searchProduct(new Event("submit"));//Load when first load page !!

function addToCart(e,id)
{
/**
 * @type={HTMLElement}
 */

    var btn=e.target;

    console.log(id);
    console.log(btn.parentNode.children.jumlah.value);
    var jumlah=btn.parentNode.children.jumlah.value;
    var body=new FormData();
    body.append("id",id);body.append("jumlah",jumlah);
    var req=new Request("ajax/add-cart.php",
    {
        method:"POST",
        body:body
    });
    alert(req);
    fetch(req)
        .then((r)=>r.json)
        .then((d)=>
        {
            alert(d.message);
        })
}


function removeFromCart(id)
{
    /**
    * @type={HTMLElement}
    */

    var body=new FormData();
    body.append("id",id);
    var req=new Request("ajax/remove-cart.php",
    {
        method:"POST",
        body:body
    });

    fetch(req)
        .then((r)=>r.json)
        .then((d)=>
        {
            alert(d.message);
            showCart();showCart();
        })
        
}


function updateCartItem(e,id)
{
    /**
 * @type={HTMLElement}
 */

     var btn=e.target;
     var jumlah=btn.parentNode.children.jumlah.value;
     var body=new FormData();
     body.append("id",id);body.append("jumlah",jumlah);
     var req=new Request("ajax/update-cart.php",
     {
         method:"POST",
         body:body
     });
     alert(req);
     fetch(req)
         .then((r)=>r.json)
         .then((d)=>
         {
             alert(d.message);
             showCart();showCart();
         })
        
}