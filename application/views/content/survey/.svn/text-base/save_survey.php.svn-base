<?php //echo'<pre>';print_r($response_data);?>
<div class="row">
    <ol class="breadcrumb">
    </ol>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="top-search pull-right">
            <?php //echo $survey_data['status']; 

             if(isset($survey_data['status']) && $survey_data['status'] == 'Closed')
             {
               $class = 'text-danger';
             }
             else
             {
                $class = 'text-success';
             }

            ?>
            
            <div class="pull-right">               
                <span class="<?php echo $class;?>">Status :<?php echo $survey_data['status']; ?></span>
                <a href="<?php echo base_url().$this->crypt->encrypt('survey/index/').'#Survey'; ?>">
                <button type="button" class="btn btn-blue"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New Template" class="uni_save_and_back" /> Back</button>
                </a>         
            </div>
        </div>
    </div>
</div>
<div class="row m-top">
	<div class="col-xs-12 error-message uni_message">
		<div class="alerts alert-danger"></div>
	</div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="row five-col">
            <div class="col-xs-3">
                <label>Survey Name:</label> 
                <input type="text" id="name" value="<?php echo isset($survey_data['name'])?$survey_data['name']:'' ?>" class="form-control" readonly />
            </div>
            <div class="col-xs-3">
                <label>Project Name:</label> 
                <input type="text" id="project_name" value="<?php echo isset($survey_data['project_name'])?$survey_data['project_name']:'' ?>" class="form-control" readonly />
            </div>
            <div class="col-xs-3">
                <label>Released By:</label> 
                <input type="text" id="first_name" value="<?php echo isset($survey_data['first_name'])?$survey_data['first_name']:'' ?>"  class="form-control" readonly />
            </div>
        </div>
        <div class="row m-top">
            <div class="col-xs-12">
                <label>Survey Description:</label> 
                <textarea class="form-control" name="description" id="description"><?php echo isset($survey_data['description'])?$survey_data['description']:'' ?></textarea>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-xs-12">
            	<div class="box-content panel-content">
            		<h4>Personal Information</h4>
            		<table>
            			<tr>
            				<td width="100"><label>Name</label></td>
            				<td width="300"><input type="text" id="first_name" value="<?php //echo isset($survey_data['first_name'])?$survey_data['first_name']:'' ?>" class="form-control" /></td>
            			</tr>
            			<tr>
            				<td width="100" height="40"><label>You are</label></td>
            				<td width="300">
            					
                                          echo// form_dropdown('account_type', $account_type_dropdown_list, '', "class='selectpicker form-control' id='account_type' data-live-search='true'"); ?>
            				</td>
            			</tr>
            		</table>					
            	</div>					
            </div>				
            </div>-->
        <form name="question_answer_form" id="question_answer_form" method="post" class="form-horizontal">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-content panel-content">
                        <h4>Survey</h4>
                        <?php if(isset($question_data)){
                            $loop_count = 0;
                            ?>
                        <?php foreach ($question_data as $key => $value) {?>
                        <table class="table borderless">
                            <tr>
                                <?php echo $value['question'];?>
                            </tr>
                            <tr>
                                <?php if($value['answer_type']== 'Numeric Scale'){?>
                                <td class="col-xs-3">
                                    <select class="selectpicker form-control2" id="numeric_answer_type" name="answer_<?php echo $loop_count;?>" >
                                        <option value="">Nothing selected</option>
                                        <option value="1" <?php echo ( isset($response_data[$loop_count]['answer'])&& $response_data[$loop_count]['answer'] == 1)? 'selected' :'' ?>>1</option>
                                        <option value="2" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 2)? 'selected' :'' ?>>2</option>
                                        <option value="3" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 3)? 'selected' :'' ?>>3</option>
                                        <option value="4" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 4)? 'selected' :'' ?>>4</option>
                                        <option value="5" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 5)? 'selected' :'' ?>>5</option>
                                        <option value="6" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 6)? 'selected' :'' ?>>6</option>
                                        <option value="7" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 7)? 'selected' :'' ?>>7</option>
                                        <option value="8" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 8)? 'selected' :'' ?>>8</option>
                                        <option value="9" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 9)? 'selected' :'' ?>>9</option>
                                        <option value="10" <?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer'] == 10)? 'selected' :'' ?>>10</option>
                                    </select>
                                </td>
                                <?php } elseif($value['answer_type']== 'Yes/No'){?>
                                <td class="col-xs-3">
                                    <select class="selectpicker form-control2" id="enum_answer_type" name="answer_<?php echo $loop_count;?>" >
                                        <option value="">Nothing selected</option>
                                        <option value="Yes"<?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer']=="Yes")?'selected':''?>>Yes</option>
                                        <option value="NO"<?php echo (isset($response_data[$loop_count]['answer'])&&$response_data[$loop_count]['answer']=="NO")?'selected':''?>>NO</option>
                                    </select>
                                </td>
                                <?php }elseif($value['answer_type']== 'Open Ended'){?>
                                <td class="col-xs-3">
                                    <input type="text" id="open_enable" id="open_ended_answer_type"  name="answer_<?php echo $loop_count;?>" class="form-control"  value="<?php echo isset($response_data[$loop_count]['answer'])?$response_data[$loop_count]['answer']:'' ?>"/>		
                                </td>
                                <?php }?>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left" width="140"  height="40"  colspan="2">
                                    <input type="checkbox" name="notapplicable_<?php echo $loop_count;?>" id="notapplicable_<?php echo $loop_count;?>" <?php echo (isset($response_data[$loop_count]['not_applicable'])&&$response_data[$loop_count]['not_applicable'] == "Yes")? 'checked' :'' ?>> Not applicable 
                                    <input type="hidden" name="survey_question_id_<?php echo $loop_count;?>" id="survey_question_id" value="<?php echo (isset($value['ub_survey_question_id']) && $value['ub_survey_question_id'] > 0)? $value['ub_survey_question_id']:0 ?>" />
                                </td>
                            </tr>
                            <?php 
                                $loop_count++;
                                } }?>
							<?php 
							if(!isset($complete_survey))
							{
							?>							
                            <tr>
                                <td height="40" align="left" width="140"  colspan="2">
                                    <button class="btn btn-blue complete_survey"  type="button" id="complete_survey"  name="complete_survey">Complete Survey</button>
                                </td>
                            </tr>
							<?php 
							}
							?>
                            <input type="hidden" name="survey_id" id="survey_id" value="<?php echo (isset($survey_id) && $survey_id > 0)? $survey_id:0 ?>" />
                            <input type="hidden" name="question_count" id="question_count" value="<?php echo (isset($question_count) )? $question_count:0 ?>" />
                        </table>
						<input type="hidden" name="project_id" id="project_id" value="<?php echo (isset($survey_data['project_id']))?$survey_data['project_id']:0 ?>" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo JSSRC.'save_survey.js';?>"></script>
