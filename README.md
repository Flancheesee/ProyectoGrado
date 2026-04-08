<h1 align="center">PROYECTO FIN DE GRADO</h1>

<h2> - ¿Que es?</h2>

<p>Este proyecto es una pagina web hecha con Laravel junto a multiples herramientas como <b>"Spatie"</b> y <b>"Stripe"</b> para la parte servidor y otras como <b>"Vite"</b> y <b>"React"</b> para la parte cliente.</p>
<p>El objetivo es plasmar en una web sobre una empresa ficticia de mudanzas junto a todos sus servicios (luego seguire explicando sus funciones).</p>

<h2> - ¿Como se despliega en local?</h2>

<p>Para desplegar este proyecto en local es necesario disponer de un programa como <b>"XAMPP"</b> en el cual puedas lanzar tanto <b>"Apache"</b> como <b>"MySQL"</b>. Este tutorial es para Windows; para usuarios de Linux y Mac puede cambiar.</p>
<p>Una vez tengas todo listo, sigue los siguientes pasos:</p>

<ol>
    <li>Abre <b>XAMPP</b> e inicia los servicios de <b>Apache</b> y <b>MySQL</b>.</li>
    <li>Extrae la carpeta del proyecto desde la rama <b>Main</b> en la carpeta local de "xampp/htdocs"</li>
    <li>Abre el terminal y escribe lo siguiente para entrar a la carpeta:
        <pre><code>cd ../..
cd xampp/htdocs/proyecto</code></pre>
    </li>
    <li>Una vez dentro de la carpeta ejecuta el servidor de Laravel:
        <pre><code>php artisan serve</code></pre>
    </li>
    <li>Ahora abre <b>otro terminal</b> y vuelve a dirigirte a la ruta del proyecto:
        <pre><code>cd xampp/htdocs/proyecto</code></pre>
    </li>
    <li>Esta vez ejecuta el compilador de activos (Vite):
        <pre><code>npm run dev</code></pre>
    </li>
</ol>

<p>Con ambos terminales en ejecución y los servicios de XAMPP activos, ya puedes acceder a la aplicación desde tu navegador.</p>

