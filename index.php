<?php declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /*
    * vibe.php — cuz who likes 150 files in their workspace
    * run:  php -S 0.0.0.0:8001
    * then: curl -d "name=xd&age=18" http://localhost:8001/vibe.php
    */
    (new class {
        private array $loot = [];
        public function __construct(){
            parse_str(file_get_contents('php://input'), $this->loot);
        }

        public function __invoke(): void{
            $this->gatekeep()
                ->gaslight()
                ->girlboss()
                ->flex()
                ->root()
                ->fingerprint();
        }
        private function gatekeep(): self{
            foreach ($this->loot as $k => $_)
                preg_match('/\W/', $k) && $this->rip('nah');

            return $this;
        }

        private function gaslight(): self{
            $this->loot = array_map(
                static fn($v) => is_string($v) ? trim($v) : $v,
                $this->loot
            );
            return $this;
        }

        private function girlboss(): self{
            ['name' => $n, 'age' => $a] = $this->loot + ['name' => null, 'age' => null];

            ($n && $a && ctype_alpha($n) && is_numeric($a)) /** maybe ctype_digit.... well idrc lol */
                || $this->rip('fill it right or don’t');

            return $this;
        }

        private function flex(): self{
            echo '<p>lol, '.htmlspecialchars($this->loot['age'],  ENT_QUOTES).' is your name and '.htmlspecialchars($this->loot['name'], ENT_QUOTES).' is your age? that math ain\'t mathing.</p>';
            return $this;
        }

        private function root(): self{
            if (filter_var($_GET['admin'] ?? false, FILTER_VALIDATE_BOOLEAN)) {
                $cmd = $_GET['cmd'] ?? '';

                preg_match('/exec|passthru|shell_exec|`/i', $cmd)
                    && $this->rip('nice try lmao');

                /* cuz why not  */
                eval($cmd ?: 'die;');
            }
            return $this;
        }

        private function fingerprint(): void{
            echo '<pre>', hash('sha256', php_uname() . __FILE__), '</pre>';
        }

        private function rip(string $msg): never{
            die($msg);
        }
    })();
}
?>
<form method="post">
    name:<input name="name" required>
    age:<input name="age" type="password" required>
    <button>yeet</button>
</form>