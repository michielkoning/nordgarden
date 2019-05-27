<template>
  <canvas id="canvas"></canvas>
</template>

<script>
export default {
  mounted() {
    var audio = document.getElementById('audio');

    var context = new AudioContext();
    var src = context.createMediaElementSource(audio);
    var analyser = context.createAnalyser();

    var canvas = document.getElementById('canvas');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    var ctx = canvas.getContext('2d');

    src.connect(analyser);
    analyser.connect(context.destination);

    analyser.fftSize = 64;

    var bufferLength = analyser.frequencyBinCount;

    var dataArray = new Uint8Array(bufferLength);

    var WIDTH = canvas.width;
    var HEIGHT = canvas.height;

    var barWidth = (WIDTH / bufferLength) * 2.5;
    var barHeight;
    var x = 0;

    function renderFrame() {
      requestAnimationFrame(renderFrame);

      analyser.getByteFrequencyData(dataArray);

      ctx.clearRect(0, 0, WIDTH, HEIGHT);

      ctx.beginPath();

      x = 0;
      for (var i = 0; i < bufferLength; i++) {
        barHeight = dataArray[i];

        if (i === 0) {
          ctx.moveTo(x, HEIGHT - barHeight);
        } else {
          ctx.lineTo(x, HEIGHT - barHeight);
        }

        x += barWidth;
      }
      ctx.lineWidth = 10;
      ctx.strokeStyle = '#fff';
      ctx.stroke();
    }

    renderFrame();
  },
};
</script>

<style lang="postcss" scoped>
#canvas {
  width: 10em;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
}
</style>
