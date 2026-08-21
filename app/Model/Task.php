<?php
class Task
{
    public array $tasks = ['Learn Php', 'Learn MVC',  'Build Project'];
    public function getTasks()
    {
        return $this->tasks;
    }
}