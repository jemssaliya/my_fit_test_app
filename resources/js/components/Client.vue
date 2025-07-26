<template>
    <div>
        <header class="grid">
            <h1>h1</h1>
            <p>aa</p>
            <a href="#section-b" class="btn">read more</a>
        </header>

        <section class="grid">
            <div class="content-wrap">
                <h2>aa</h2>
                <p>hahahahaha</p>
            </div>
        </section>
        <section class="grid">
            <ul>
                <li>
                    <div class="card">
                        <img src="../../views/lap.jpg" alt="">
                        <div class="card-content">
                            <h3 class="card-title">
                                client
                            </h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta quod at nisi, recusandae
                                eum esse? Temporibus sit quasi totam natus.
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="card">
                        <img src="../../views/lap.jpg" alt="">
                        <div class="card-content">
                            <h3 class="card-title">
                                client
                            </h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta quod at nisi, recusandae
                                eum esse? Temporibus sit quasi totam natus.
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="card">
                        <img src="../../views/lap.jpg" alt="">
                        <div class="card-content">
                            <h3 class="card-title">
                                client
                            </h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta quod at nisi, recusandae
                                eum esse? Temporibus sit quasi totam natus.
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </section>
        <section class="grid">
            <div class="content-wrap">
                <h2>haha</h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro deleniti voluptatum quia amet dolorem
                    rerum doloribus, inventore magni labore non.
                </p>
            </div>
        </section>
        <section class="grid">
            <div class="box">
                <h2 class="content-title">
                    contact
                </h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, nulla in. Eos veritatis
                    reprehenderit maxime incidunt quod cumque molestiae quibusdam!
                </p>
                <p>email</p>
            </div>
            <div class="box">
                <h2 class="content-title">
                    about
                </h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum necessitatibus impedit, odio,
                    cupiditate asperiores illum earum aperiam vel, explicabo repellat voluptates soluta facere adipisci
                    distinctio laboriosam quia quas minus nemo.
                </p>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: ['title', 'author']
    }
</script>
<style scoped>
    html, body {
        background-color: #fff;
        color: #939b9f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .title {
        font-size: 60px;
    }

    .subtitle {
        font-size: 20px;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .client {
        background-color: aliceblue;
    }
</style>
