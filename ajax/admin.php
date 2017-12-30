<?php
include '../dao/AdminDao.php';

$admin=new AdminDao();

if (isset($_POST['id'])){
    $baby_id=$_POST['id'];
    $docRes=$admin->findDoctorByBabyId($baby_id);
    $sisRes=$admin->findSisterByBabyId($baby_id);

    if ($docRes->num_rows>0){
        $docRows=$docRes->fetch_assoc();
        $data['username']=$docRows['username'];
        $data['user_id']=$docRows['user_id'];
        $data['name']=$docRows['firstname'].' '.$docRows['lastname'];
        $data['doc_id']=$docRows['doc_id'];
        if ($docRows['slot-1']==$baby_id){
            $data['slot']=1;
        }
        else if ($docRows['slot-2']==$baby_id){
            $data['slot']=2;
        }
        else{
            $data['slot']=3;
        }
    }
    else{
        $data['msg']="Not Assigned";
    }
    if ($sisRes->num_rows>0){
        $sisRow=$sisRes->fetch_assoc();
        $data['user_sis']=$sisRow['username'];
        $data['u_id']=$sisRow['user_id'];
        $data['name_sis']=$sisRow['firstname'].' '.$sisRow['lastname'];
        $data['sis_id']=$sisRow['sis_id'];
    }
    else{
        $data['msg']="Not Assigned";
    }
    echo json_encode($data);
}
?>