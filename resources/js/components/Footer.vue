<template>
  <footer class="footer-content">
    <p class="footer-content-paragraph">
      {{ $t('footer_section.first_paragraph.title') }}
    </p>
    <p class="footer-content-paragraph">
      {{ $t('footer_section.second_paragraph.title') }}
      <a href="https://vuejs.org/v2/guide/" :title="$t('footer_section.second_paragraph.vuejs_tooltip')" taget="_blank">VueJs v2</a> and
      <a href="https://laravel.com/docs/8.x/releases" :title="$t('footer_section.second_paragraph.laravel_tooltip')" taget="_blank">Laravel v8</a>
    </p>
    <p class="footer-content-paragraph">
      <span>{{ $t('footer_section.third_paragraph.title') }}</span>
      <a href="https://github.com/liviu10" :title="$t('footer_section.third_paragraph.github_tooltip')">Github</a> |
      <a href="https://www.linkedin.com/in/liviu-voica-849732a4/" :title="$t('footer_section.third_paragraph.linkedin_tooltip')">Linkedin</a>
    </p>
    <p class="footer-content-paragraph">
      <span>Copyright ©</span>
      <a href="https://liviu-voica.ro/">Liviu Voica</a>
      2021
    </p>
  </footer>
</template>

<script>

export default {
  name: 'Footer'
}
</script>

<style lang="scss" scoped>
    .footer-content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin: 48px 0px;
        &-paragraph {
            margin-bottom: 0px !important;
            user-select: none;
            & span {
                font-weight: bold;
            }
        }
        &-paragraph:first-of-type {
            font-size: 20px;
        }
    }
</style>
