# Laravel Surge

**Laravel Surge** is a lightweight, scalable **async task dispatcher** + **worker manager** package built for Laravel.  
It gives you real-time control over background jobs directly from artisan commands, without heavy server setups.

> No stress. No bloated overhead. Just pure async vibes. 🚀

---

## 🔥 Current Features

- **Async Dispatching**  
  Instantly dispatch any Laravel job class asynchronously with one simple call.

- **Worker Process Management**
  - Start multiple background workers.
  - Stop all running workers gracefully.
  - Restart workers cleanly.
  - Check the status of all running workers.

- **Blade View Support**  
  Prebuilt blade templates available to display status visually.

- **Artisan Commands**
  ```bash
  php artisan surge:start {workers?}
  php artisan surge:stop
  php artisan surge:restart {workers?}
  php artisan surge:status
  ```

- **Logging**  
  Full lifecycle logging to monitor job dispatching, worker starting, stopping, failures, etc.

- **Configuration Publishing**  
  Customize settings like number of workers, sleep time, queue name, max tries, and more.

---

## 🛠 Installation

Want to Surge into your project? Here's the 5-minute install guide:

1. **Require the package via Composer**
   ```bash
   composer require iamthesaifullah/laravel-surge
   ```

2. **Publish Config and View Files**
   ```bash
   php artisan vendor:publish --provider="IamThesaifullah\Surge\SurgeServiceProvider"
   ```
   This will publish:
   - `config/surge.php`
   - Blade views into `resources/views/vendor/surge`

3. **Queue Setup**  
   Make sure your Laravel app's queue system is configured (`database`, `redis`, `sqs`, etc).  
   Surge will use whatever is set in your `queue.default` config — or you can override it inside `config/surge.php`.

4. **Usage Examples**

   - **Dispatch a Job**
     ```php
     \IamThesaifullah\Surge\Facades\Surge::dispatch(\App\Jobs\ExampleJob::class, [$param1, $param2]);
     ```

   - **Start Workers**
     ```bash
     php artisan surge:start 3
     ```
     (Starts 3 workers. If no number is provided, falls back to config.)

   - **Stop Workers**
     ```bash
     php artisan surge:stop
     ```

   - **Check Worker Status**
     ```bash
     php artisan surge:status
     ```

   - **Restart Workers**
     ```bash
     php artisan surge:restart 2
     ```

---

## 🔮 Upcoming Features

- **Dashboard UI**  
  View running jobs, worker statuses, and live stats directly from a dashboard.

- **Auto-Restart Dead Workers**  
  Surge will detect dead workers and automatically restart them.

- **Failed Job Monitoring**  
  Hook into Laravel’s failed jobs and attempt retries if configured.

- **Dynamic Job Priority Queues**  
  Prioritize high-importance jobs on the fly.

- **Surge Scheduling**  
  Support delayed jobs and scheduled surges.

---

## ⚡ Short Description

Laravel Surge is your async sidekick — making **background job processing ridiculously easy** inside any Laravel app.  
Start, stop, restart, and monitor background workers like a boss — with clean artisan commands and full logging.

Perfect for **MVPs, startups, internal tools,** and **serious Laravel devs** who want simple but powerful background job handling.

---

## 👤 Author

**Md Saifullah**  
- [LinkedIn](https://www.linkedin.com/in/iamthesaifullah/)
- [GitHub](https://github.com/iamthesaifullah)
- [Website](https://iamthesaifullah.com)

---

## 📜 License

This project is open-sourced software licensed under the [MIT license](https://github.com/iamthesaifullah/Laravel-Surge/blob/main/LICENSE).

---

## 💬 Feedback & Contributions

If you like it, **star it** ⭐️.  
If you love it, **contribute** 🔥.  
If you break it, **open an issue** 💬.

Pull Requests always welcome!

---

> 🚀 Let's Surge Laravel into the future together.

---