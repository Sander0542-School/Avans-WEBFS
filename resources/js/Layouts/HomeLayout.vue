<template>
  <div class="home-layout">
    <div class="layout-grid">
      <div class="header">
        <table class="p-2 w-100">
          <tbody>
          <tr style="height:50px">
            <td style="text-align:center;width:30%;color:yellow;font-size:30px">
              <img style="vertical-align: middle;" src="/pictures/dragon-small.png" alt="Golden Dragon" height="50px">
              <span style="font-family:'chinese_takeawayregular'">De Gouden Draak</span>
              <img style="vertical-align: middle;" src="/pictures/dragon-small-flipped.png" alt="Golden Dragon" height="50px">
            </td>
            <td>
              <a href="paginas/aanbiedingen.html" style="color:yellow;font-weight:bold;text-decoration: none;">
                <marquee behavior="scroll" direction="left">
                  Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!
                </marquee>
              </a>
            </td>
            <td style="text-align:center;width:30%;color:yellow;font-size:30px">
              <img style="vertical-align: middle;" src="/pictures/dragon-small.png" alt="Golden Dragon" height="50px">
              <span style="font-family:'chinese_takeawayregular'">De Gouden Draak</span>
              <img style="vertical-align: middle;" src="/pictures/dragon-small-flipped.png" alt="Golden Dragon" height="50px">
            </td>
          </tr>
          </tbody>
        </table>
      </div>

      <div class="cell left top"/>
      <div class="cell right top"/>
      <div class="cell right"/>
      <div class="cell top"/>
      <div class="cell left"/>
      <div class="cell left top"/>
      <div class="cell right top"/>

      <div class="cell left bottom"/>
      <div class="cell all"/>
      <div class="cell top bottom right"/>
      <div class="cell top"/>
      <div class="cell top bottom left"/>
      <div class="cell all"/>
      <div class="cell right bottom"/>

      <div class="cell bottom"/>
      <div class="cell right bottom left"/>
      <div class="cell"/>
      <div class="cell"/>
      <div class="cell"/>
      <div class="cell right bottom left"/>
      <div class="cell bottom"/>

      <div class="cell left"/>
      <div class="cell left"/>
      <div class="cell"/>
      <div class="cell">
        <slot></slot>
      </div>
      <div class="cell"/>
      <div class="cell right"/>
      <div class="cell right"/>

      <div class="cell top"/>
      <div class="cell right top left"/>
      <div class="cell"/>
      <div class="cell"/>
      <div class="cell"/>
      <div class="cell right top left"/>
      <div class="cell top"/>

      <div class="cell left top"/>
      <div class="cell all"/>
      <div class="cell top bottom right"/>
      <div class="cell bottom"/>
      <div class="cell top bottom left"/>
      <div class="cell all"/>
      <div class="cell right top"/>

      <div class="cell left bottom"/>
      <div class="cell right bottom"/>
      <div class="cell right"/>
      <div class="cell bottom"/>
      <div class="cell left"/>
      <div class="cell left bottom"/>
      <div class="cell right bottom"/>
    </div>
  </div>
</template>

<script>
export default {
  name: "HomeLayout"
}
</script>

<style scoped>

</style>