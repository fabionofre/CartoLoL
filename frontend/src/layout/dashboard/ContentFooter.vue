<template>
  <footer class="footer">
    <div class="container-fluid">
      <div class="copyright">
        © {{year}} feito com <i class="tim-icons icon-heart-2"></i> por
        <a href="https://github.com/fabionofre/CartoLoL" target="_blank">ZLeague</a>
      </div>
    </div>
  </footer>
</template>
<script>
  export default {
    data() {
      return {
        year: new Date().getFullYear()
      }
    }
  };
</script>
<style>
</style>
