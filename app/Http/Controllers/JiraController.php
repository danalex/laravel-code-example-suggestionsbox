<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\Worklog;
use JiraRestApi\JiraException;
use JiraRestApi\Project\ProjectService;
use Univerze\Jira\Jira;

class JiraController extends Controller
{
	public  function view(){
		return view('jira.view');
	}

	public  function show(){


/*		try {
			$proj = new ProjectService();

			$prjs = $proj->getAllProjects();

			foreach ($prjs as $p) {
				echo sprintf("Project Key:%s, Id:%s, Name:%s, projectCategory: %s\n",
					$p->key, $p->id, $p->name, $p->projectCategory['name']
				);

			}
		} catch (JiraException $e) {
			print("Error Occured! " . $e->getMessage());
		}*/
		$issueKey = Input::get('ticket_id');
		/*try {
			$issueService = new IssueService();
			$worklogs = $issueService->getWorklog('EC-9369')->getWorklogs();
			var_dump($worklogs);

		} catch (JiraException $e) {
			var_dump($e->getMessage());
		}*/


	}
}
