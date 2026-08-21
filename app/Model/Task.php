<?php
class Task
{
    public array $tasks = [
        'Learn Php' => 'For Future',
        'Learn MVC'=>'For Job',
        'Build Project'=>'For Legacy'
    ];
    public function getTasks()
    {
        return $this->tasks;
    }
    public function create($title, $description)
    {
        $this->tasks[$title] = $description;
    }
}