$(document).ready(function () {

    count();

    function count() {
        let shopString = localStorage.getItem('shops');
        if(shopString){
            let shopArray = JSON.parse(shopString);

            if(shopArray != null) {
                $('#count_item').text(shopArray.length);
            }
        }
    }

    $('.addToCart').click(function(){
        // alert('Hello');
        let id = $(this).data('id');
        let name = $(this).data('name');
        let codeNo = $(this).data('codeno');
        let price = $(this).data('price');
        let discount = $(this).data('discount');
        let qty = $('.qty').val();

        // console.log(id,name,price);

        let shop_items = {
            id: id,
            name: name,
            codeNo: codeNo,
            price: price,
            discount: discount,
            qty: qty
        }
        // console.log(shop_items);
        let shopString = localStorage.getItem('shops');
        let shopArray;
        if(shopString == null) {
            shopArray = [];
        }else {
            shopArray = JSON.parse(shopString);
        }

        let status = false;
        $.each(shopArray,function(i,v){
            if(id == v.id) {
                status = true;
                v.qty = Number(v.qty)+Number(qty);
            }
        })

        if (status == false) {
            shopArray.push(shop_items);
        }

        let shopData = JSON.stringify(shopArray);
        localStorage.setItem('shops', shopData);

        count();

    })

    getData();
    function getData(){
        let shopString = localStorage.getItem('shops');
        if(shopString) {
            let shopArray = JSON.parse(shopString);

            let data = '';
            let k = 1;
            let total = 0;
            $.each(shopArray, function(i,v){
                let discountPrice = v.price - ((v.discount/100)*v.price);
                console.log(discountPrice);
                data += `<tr>
                            <td>${k++}</td>
                            <td>${v.codeNo}</td>
                            <td>${v.name}</td>
                            <td>${v.price}</td>
                            <td>${v.discount}%</td>

                            <td>
                                <button class="btn btn-sm bg-primary min" data-key="${i}"> - </button>
                                ${v.qty}
                                <button class="btn btn-sm bg-primary max" data-key="${i}"> + </button>
                            </td>
                            <td>${discountPrice * v.qty} MMK</td>
                        </tr>`;
                        total += discountPrice * v.qty;
            });
            data += `<tr>
                        <td colspan="6">Total</td>
                        <td>${total} MMK</td>
                    </tr>`;

                    console.log(data);
            $('#itemTbody').html(data);
        }
    }

    $('#itemTbody').on('click','.min',function(){
        // alert('Hello');
        let key = $(this).data('key');
        console.log(key);

        let shopString = localStorage.getItem('shops');
        if(shopString) {
            let shopArray = JSON.parse(shopString);

            $.each(shopArray,function(i,v){
                if(key == i) {
                    v.qty--;
                    if(v.qty == 0) {
                        shopArray.splice(key,1);
                    }
                }
            })

            let shopData = JSON.stringify(shopArray);
            localStorage.setItem('shops',shopData);

            getData();
        }

    })

    $('#itemTbody').on('click','.max',function(){
        // alert('Hello');
        let key = $(this).data('key');
        console.log(key);

        let shopString = localStorage.getItem('shops');
        if(shopString) {
            let shopArray = JSON.parse(shopString);

            $.each(shopArray,function(i,v){
                if(key == i) {
                    v.qty++;
                }
            })

            let shopData = JSON.stringify(shopArray);
            localStorage.setItem('shops',shopData);

            getData();
        }

    })

    $('#order_now').click(function(){
        let ans = confirm('Are you sure order?');
        if(ans){
            localStorage.removeItem('shops');
            window.location.href = 'index.html';
        }
    })

});