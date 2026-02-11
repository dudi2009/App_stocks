<style>
img{
    width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}
h1{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  text-align: center;
  color: white;
}
img::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));
}
.img-wrapper {
    position: relative;
    width: 100%;
    height: 100vh;
}
.img-wrapper::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));
    pointer-events: none;
}
</style>
<div class="img-wrapper">
  <img src="https://i.pinimg.com/736x/59/e5/b2/59e5b2f50d98a56a32b62a749b0703a5.jpg" alt="" class="">
</div>
<div class="container">
    <div class="row">
        <h1 class="my-4 text-center">Selamat datang di aplikasi stock barang</h1>
    </div>
</div>