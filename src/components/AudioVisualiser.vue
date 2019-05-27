<template>
  <canvas ref="canvas"></canvas>
</template>

<script>
export default {
  mounted() {
    var audio = document.getElementById('audio');

    var context = new AudioContext();
    var src = context.createMediaElementSource(audio);
    var analyser = context.createAnalyser();

    var canvas = this.$refs.canvas;

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    var ctx = canvas.getContext('2d');

    src.connect(analyser);
    analyser.connect(context.destination);

    analyser.fftSize = 512;

    var bufferLength = analyser.frequencyBinCount;

    var dataArray = new Uint8Array(bufferLength);

    var WIDTH = canvas.width;
    var HEIGHT = canvas.height;

    var barWidth;
    var barHeight = (HEIGHT / bufferLength) * 5;
    var y = 0;

    function renderFrame() {
      requestAnimationFrame(renderFrame);

      analyser.getByteFrequencyData(dataArray);

      ctx.clearRect(0, 0, WIDTH, HEIGHT);

      ctx.beginPath();
      console.log(dataArray);

      y = 0;
      for (var i = 0; i < bufferLength; i++) {
        barWidth = dataArray[i];

        if (i === 0) {
          ctx.moveTo(barWidth, y);
        } else {
          ctx.lineTo(barWidth, y);
        }

        y += barHeight;
      }
      ctx.lineWidth = 60;
      ctx.strokeStyle = '#fff';
      ctx.stroke();
    }

    renderFrame();
  },
};
</script>

<style lang="postcss" scoped>
canvas {
  width: 5em;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 20rem;
}
</style>
